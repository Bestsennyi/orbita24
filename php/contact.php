<?php
declare(strict_types=1);

const CONTACT_RECIPIENT = 'info@orbita24.de';

function redirect_to_contact(string $status): void
{
    header('Location: ../kontakt.html?status=' . rawurlencode($status), true, 303);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_to_contact('error');
}

$honeypot = trim((string)($_POST['website'] ?? ''));
if ($honeypot !== '') {
    redirect_to_contact('sent');
}

$name = trim((string)($_POST['name'] ?? ''));
$email = trim((string)($_POST['email'] ?? ''));
$message = trim((string)($_POST['message'] ?? ''));

if (
    $name === ''
    || strlen($name) > 240
    || !filter_var($email, FILTER_VALIDATE_EMAIL)
    || $message === ''
    || strlen($message) > 10000
) {
    redirect_to_contact('error');
}

$safeName = str_replace(["\r", "\n"], ' ', $name);
$safeEmail = str_replace(["\r", "\n"], '', $email);
$subject = 'Neue Anfrage über Orbita24';
$body = "Name: {$safeName}\nE-Mail: {$safeEmail}\n\nNachricht:\n{$message}\n";
$headers = [
    'From: Orbita24 <no-reply@orbita24.de>',
    'Reply-To: ' . $safeEmail,
    'Content-Type: text/plain; charset=UTF-8',
];

$sent = mail(CONTACT_RECIPIENT, $subject, $body, implode("\r\n", $headers));

redirect_to_contact($sent ? 'sent' : 'error');
