<?php
declare(strict_types=1);

use PHPMailer\PHPMailer\Exception as MailerException;
use PHPMailer\PHPMailer\PHPMailer;

function orbita24_start_contact_session(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function orbita24_e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function orbita24_text_length(string $value): int
{
    return function_exists('mb_strlen') ? mb_strlen($value, 'UTF-8') : strlen($value);
}

function orbita24_new_csrf_token(): string
{
    $_SESSION['contact_csrf_token'] = bin2hex(random_bytes(32));
    return $_SESSION['contact_csrf_token'];
}

function orbita24_get_csrf_token(): string
{
    if (empty($_SESSION['contact_csrf_token']) || !is_string($_SESSION['contact_csrf_token'])) {
        return orbita24_new_csrf_token();
    }

    return $_SESSION['contact_csrf_token'];
}

function orbita24_redirect_contact(): void
{
    header('Location: kontakt.php', true, 303);
    exit;
}

function orbita24_set_contact_flash(string $type, string $message, array $old = []): void
{
    $_SESSION['contact_flash'] = [
        'type' => $type,
        'message' => $message,
        'old' => $old,
    ];
}

function orbita24_take_contact_flash(): array
{
    $flash = $_SESSION['contact_flash'] ?? null;
    unset($_SESSION['contact_flash']);

    if (!is_array($flash)) {
        return [
            'type' => '',
            'message' => '',
            'old' => [
                'name' => '',
                'email' => '',
                'message' => '',
            ],
        ];
    }

    $old = is_array($flash['old'] ?? null) ? $flash['old'] : [];

    return [
        'type' => is_string($flash['type'] ?? null) ? $flash['type'] : '',
        'message' => is_string($flash['message'] ?? null) ? $flash['message'] : '',
        'old' => [
            'name' => is_string($old['name'] ?? null) ? $old['name'] : '',
            'email' => is_string($old['email'] ?? null) ? $old['email'] : '',
            'message' => is_string($old['message'] ?? null) ? $old['message'] : '',
        ],
    ];
}

function orbita24_has_header_injection(string $value): bool
{
    return preg_match('/[\r\n]/', $value) === 1;
}

function orbita24_validate_contact(array $post): array
{
    $name = trim((string)($post['name'] ?? ''));
    $email = trim((string)($post['email'] ?? ''));
    $message = trim((string)($post['message'] ?? ''));

    $old = [
        'name' => $name,
        'email' => $email,
        'message' => $message,
    ];

    $isValid = $name !== ''
        && $email !== ''
        && $message !== ''
        && orbita24_text_length($name) <= 120
        && orbita24_text_length($email) <= 190
        && orbita24_text_length($message) <= 5000
        && filter_var($email, FILTER_VALIDATE_EMAIL)
        && !orbita24_has_header_injection($name)
        && !orbita24_has_header_injection($email);

    return [$isValid, $old];
}

function orbita24_send_contact_mail(array $data): bool
{
    $autoload = __DIR__ . '/../vendor/autoload.php';
    if (!is_file($autoload)) {
        error_log('Orbita24 Kontaktformular: PHPMailer Autoload wurde nicht gefunden.');
        return false;
    }

    require_once $autoload;

    $config = require __DIR__ . '/config.php';
    $mail = new PHPMailer(true);

    try {
        // SMTP-Versand ueber den Provider, keine mail()-Fallbacks.
        $mail->isSMTP();
        $mail->Host = (string)$config['SMTP_HOST'];
        $mail->SMTPAuth = true;
        $mail->Username = (string)$config['SMTP_USERNAME'];
        $mail->Password = (string)$config['SMTP_PASSWORD'];
        $mail->Port = (int)$config['SMTP_PORT'];

        $encryption = strtolower((string)$config['SMTP_ENCRYPTION']);
        if ($encryption === 'tls') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        } elseif ($encryption === 'ssl') {
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        }

        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->setFrom((string)$config['MAIL_FROM_ADDRESS'], (string)$config['MAIL_FROM_NAME']);
        $mail->addAddress((string)$config['MAIL_TO_ADDRESS']);
        $mail->addReplyTo($data['email'], $data['name']);
        $mail->Subject = 'Neue Kontaktanfrage über Orbita24';
        $mail->isHTML(false);

        $date = (new DateTimeImmutable('now', new DateTimeZone('Europe/Berlin')))->format('d.m.Y H:i:s');
        $ip = $_SERVER['REMOTE_ADDR'] ?? '';

        $mail->Body = implode("\n", [
            'Neue Kontaktanfrage über Orbita24',
            '',
            'Name: ' . $data['name'],
            'E-Mail: ' . $data['email'],
            'Datum/Uhrzeit: ' . $date,
            $ip !== '' ? 'IP: ' . $ip : '',
            '',
            'Nachricht:',
            $data['message'],
        ]);

        return $mail->send();
    } catch (MailerException $exception) {
        error_log('Orbita24 Kontaktformular: Versand fehlgeschlagen.');
        return false;
    }
}

function orbita24_handle_contact_request(): array
{
    orbita24_start_contact_session();

    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
        // CSRF-Pruefung und PRG-Redirect verhindern doppelte Sendungen beim Aktualisieren.
        $token = (string)($_POST['csrf_token'] ?? '');
        $sessionToken = (string)($_SESSION['contact_csrf_token'] ?? '');
        $oldInput = [
            'name' => trim((string)($_POST['name'] ?? '')),
            'email' => trim((string)($_POST['email'] ?? '')),
            'message' => trim((string)($_POST['message'] ?? '')),
        ];

        if ($sessionToken === '' || !hash_equals($sessionToken, $token)) {
            orbita24_new_csrf_token();
            orbita24_set_contact_flash('error', 'Bitte laden Sie die Seite neu und versuchen Sie es erneut.', $oldInput);
            orbita24_redirect_contact();
        }

        $honeypot = trim((string)($_POST['website'] ?? ''));
        if ($honeypot !== '') {
            orbita24_new_csrf_token();
            orbita24_set_contact_flash('success', 'Ihre Nachricht wurde erfolgreich gesendet. Wir melden uns so schnell wie möglich.');
            orbita24_redirect_contact();
        }

        [$isValid, $data] = orbita24_validate_contact($_POST);
        if (!$isValid) {
            orbita24_new_csrf_token();
            orbita24_set_contact_flash('error', 'Bitte füllen Sie alle Pflichtfelder korrekt aus.', $data);
            orbita24_redirect_contact();
        }

        $sent = orbita24_send_contact_mail($data);
        orbita24_new_csrf_token();

        if ($sent) {
            orbita24_set_contact_flash('success', 'Ihre Nachricht wurde erfolgreich gesendet. Wir melden uns so schnell wie möglich.');
        } else {
            orbita24_set_contact_flash('error', 'Beim Senden ist ein Fehler aufgetreten. Bitte versuchen Sie es später erneut.', $data);
        }

        orbita24_redirect_contact();
    }

    $state = orbita24_take_contact_flash();
    $state['csrf_token'] = orbita24_get_csrf_token();

    return $state;
}
