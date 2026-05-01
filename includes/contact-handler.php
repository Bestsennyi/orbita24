<?php
declare(strict_types=1);

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

function orbita24_set_contact_flash(string $type, string $message, array $old = [], array $events = []): void
{
    $_SESSION['contact_flash'] = [
        'type' => $type,
        'message' => $message,
        'old' => $old,
        'events' => $events,
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
            'events' => [],
        ];
    }

    $old = is_array($flash['old'] ?? null) ? $flash['old'] : [];
    $events = is_array($flash['events'] ?? null) ? $flash['events'] : [];

    return [
        'type' => is_string($flash['type'] ?? null) ? $flash['type'] : '',
        'message' => is_string($flash['message'] ?? null) ? $flash['message'] : '',
        'old' => [
            'name' => is_string($old['name'] ?? null) ? $old['name'] : '',
            'email' => is_string($old['email'] ?? null) ? $old['email'] : '',
            'message' => is_string($old['message'] ?? null) ? $old['message'] : '',
        ],
        'events' => array_values(array_filter($events, 'is_string')),
    ];
}

function orbita24_has_header_injection(string $value): bool
{
    return preg_match('/[\r\n]/', $value) === 1;
}

function orbita24_clean_text(string $value): string
{
    $value = str_replace("\0", '', $value);
    return trim($value);
}

function orbita24_clean_multiline_text(string $value): string
{
    $value = str_replace("\0", '', $value);
    $value = str_replace(["\r\n", "\r"], "\n", $value);
    return trim($value);
}

function orbita24_validate_contact(array $post): array
{
    $name = orbita24_clean_text((string)($post['name'] ?? ''));
    $email = orbita24_clean_text((string)($post['email'] ?? ''));
    $message = orbita24_clean_multiline_text((string)($post['message'] ?? ''));

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

function orbita24_encode_mail_header(string $value): string
{
    return '=?UTF-8?B?' . base64_encode($value) . '?=';
}

function orbita24_send_contact_mail(array $data): bool
{
    if (!function_exists('mail')) {
        error_log('Orbita24 Kontaktformular: PHP mail() ist nicht verfuegbar.');
        return false;
    }

    $config = require __DIR__ . '/config.php';

    $to = orbita24_clean_text((string)($config['MAIL_TO_ADDRESS'] ?? ''));
    $from = orbita24_clean_text((string)($config['MAIL_FROM_ADDRESS'] ?? ''));
    $fromName = orbita24_clean_text((string)($config['MAIL_FROM_NAME'] ?? 'Orbita24'));

    if (
        !filter_var($to, FILTER_VALIDATE_EMAIL)
        || !filter_var($from, FILTER_VALIDATE_EMAIL)
        || orbita24_has_header_injection($to)
        || orbita24_has_header_injection($from)
        || orbita24_has_header_injection($fromName)
    ) {
        error_log('Orbita24 Kontaktformular: Mail-Konfiguration ist ungueltig.');
        return false;
    }

    $date = (new DateTimeImmutable('now', new DateTimeZone('Europe/Berlin')))->format('d.m.Y H:i:s');
    $ip = orbita24_clean_text((string)($_SERVER['REMOTE_ADDR'] ?? ''));
    $subject = orbita24_encode_mail_header('Neue Kontaktanfrage über Orbita24');

    $bodyLines = [
        'Neue Kontaktanfrage über Orbita24',
        '',
        'Name: ' . $data['name'],
        'E-Mail: ' . $data['email'],
        'Datum/Uhrzeit: ' . $date,
    ];

    if ($ip !== '') {
        $bodyLines[] = 'IP: ' . $ip;
    }

    $bodyLines[] = '';
    $bodyLines[] = 'Nachricht:';
    $bodyLines[] = $data['message'];
    $body = implode("\n", $bodyLines);

    $headers = [
        'From: ' . orbita24_encode_mail_header($fromName) . ' <' . $from . '>',
        'Reply-To: ' . $data['email'],
        'MIME-Version: 1.0',
        'Content-Type: text/plain; charset=UTF-8',
        'Content-Transfer-Encoding: 8bit',
        'X-Mailer: PHP/' . PHP_VERSION,
    ];

    $headerText = implode("\r\n", $headers);
    $sent = @mail($to, $subject, $body, $headerText, '-f' . $from);

    if (!$sent) {
        $sent = @mail($to, $subject, $body, $headerText);
    }

    return $sent;
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
            orbita24_set_contact_flash('error', 'Bitte Seite neu laden und erneut versuchen.', $oldInput);
            orbita24_redirect_contact();
        }

        $honeypot = trim((string)($_POST['website'] ?? ''));
        if ($honeypot !== '') {
            orbita24_new_csrf_token();
            orbita24_set_contact_flash('success', 'Vielen Dank! Wir melden uns bald.');
            orbita24_redirect_contact();
        }

        [$isValid, $data] = orbita24_validate_contact($_POST);
        if (!$isValid) {
            orbita24_new_csrf_token();
            orbita24_set_contact_flash('error', 'Bitte alle Pflichtfelder korrekt ausfüllen.', $data);
            orbita24_redirect_contact();
        }

        $sent = orbita24_send_contact_mail($data);
        orbita24_new_csrf_token();

        if ($sent) {
            orbita24_set_contact_flash('success', 'Vielen Dank! Wir melden uns bald.');
        } else {
            orbita24_set_contact_flash('error', 'Fehler beim Senden. Bitte später erneut versuchen.', $data);
        }

        orbita24_redirect_contact();
    }

    $state = orbita24_take_contact_flash();
    $state['csrf_token'] = orbita24_get_csrf_token();

    return $state;
}
