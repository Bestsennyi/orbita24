<?php
declare(strict_types=1);

// SMTP-Konfiguration fuer IONOS. Bitte das Passwort vor dem Livegang eintragen.
return [
    'SMTP_HOST' => 'smtp.ionos.de',
    'SMTP_PORT' => 587,
    'SMTP_USERNAME' => 'kontakt@orbita24.de',
    'SMTP_PASSWORD' => 'SMTP_PASSWORT_EINTRAGEN',
    'SMTP_ENCRYPTION' => 'tls',
    'MAIL_FROM_ADDRESS' => 'kontakt@orbita24.de',
    'MAIL_FROM_NAME' => 'Orbita24',
    'MAIL_TO_ADDRESS' => 'kontakt@orbita24.de',
];
