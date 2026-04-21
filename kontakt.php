<?php
declare(strict_types=1);

require __DIR__ . '/includes/contact-handler.php';

$contactState = orbita24_handle_contact_request();
$contactType = $contactState['type'];
$contactMessage = $contactState['message'];
$oldInput = $contactState['old'];
$csrfToken = $contactState['csrf_token'];
?>
<!doctype html>
<html lang="de">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kontakt – Orbita24</title>
    <meta
      name="description"
      content="Kontaktieren Sie Orbita24 schnell und unkompliziert. Schreiben Sie uns über das Kontaktformular oder per E-Mail."
    />
    <meta name="robots" content="index, follow" />
    <meta name="theme-color" content="#111827" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="de_DE" />
    <meta property="og:site_name" content="Orbita24" />
    <meta property="og:title" content="Kontakt – Orbita24" />
    <meta
      property="og:description"
      content="Schreiben Sie uns einfach. Wir melden uns so schnell wie möglich zurück."
    />
    <meta property="og:url" content="https://orbita24.de/kontakt.php" />
    <meta property="og:image" content="https://orbita24.de/images/hero-bg.webp" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Kontakt – Orbita24" />
    <meta
      name="twitter:description"
      content="Schreiben Sie uns einfach. Wir melden uns so schnell wie möglich zurück."
    />
    <meta name="twitter:image" content="https://orbita24.de/images/hero-bg.webp" />
    <link rel="canonical" href="https://orbita24.de/kontakt.php" />
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png" />
    <link rel="manifest" href="site.webmanifest" />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body class="page-sticky">
    <div class="site-bg" aria-hidden="true"></div>

    <header class="site-header">
      <div class="container nav">
        <a href="index.html" class="logo" aria-label="Orbita24 Startseite">
          <img src="images/logo-orbita24.svg" alt="Orbita24 Logo" class="logo-img" />
        </a>

        <button
          class="nav-toggle"
          aria-label="Menü öffnen"
          aria-expanded="false"
          aria-controls="main-navigation"
        >
          <span></span>
          <span></span>
          <span></span>
        </button>

        <nav class="nav-menu" id="main-navigation" aria-label="Hauptnavigation">
          <a href="index.html">Startseite</a>
          <a href="optionen.html" class="nav-mobile-only">Optionen</a>
          <a href="about.html">Über uns</a>
          <a href="kontakt.php" class="active" aria-current="page">Kontakt</a>
        </nav>

        <a href="optionen.html" class="btn btn-primary nav-cta">Alle Optionen ansehen</a>
      </div>
    </header>

    <main>
      <section class="section page-section">
        <div class="container kontakt-layout">
          <div class="kontakt-main">
            <div class="page-header">
              <p class="eyebrow">KONTAKT</p>
              <h1>Schreiben Sie uns</h1>
              <p>Bei Fragen oder Anliegen können Sie uns schnell und unkompliziert kontaktieren.</p>
            </div>

            <article class="card form-card kontakt-form-card">
              <p class="form-intro">
                Schreiben Sie uns einfach eine Nachricht - wir melden uns so schnell wie möglich.
              </p>

              <form class="contact-form kontakt-form" action="kontakt.php" method="post" accept-charset="UTF-8">
                <input type="hidden" name="csrf_token" value="<?= orbita24_e($csrfToken) ?>" />

                <div class="form-group">
                  <label for="name">Name</label>
                  <input
                    id="name"
                    name="name"
                    type="text"
                    autocomplete="name"
                    maxlength="120"
                    value="<?= orbita24_e($oldInput['name']) ?>"
                    required
                    aria-describedby="name-error"
                  />
                  <p class="field-error" id="name-error"></p>
                </div>

                <div class="form-group">
                  <label for="email">E-Mail</label>
                  <input
                    id="email"
                    name="email"
                    type="email"
                    autocomplete="email"
                    maxlength="190"
                    value="<?= orbita24_e($oldInput['email']) ?>"
                    required
                    aria-describedby="email-error"
                  />
                  <p class="field-error" id="email-error"></p>
                </div>

                <div class="form-group">
                  <label for="message">Nachricht</label>
                  <textarea
                    id="message"
                    name="message"
                    rows="3"
                    maxlength="5000"
                    required
                    aria-describedby="message-error"
                  ><?= orbita24_e($oldInput['message']) ?></textarea>
                  <p class="field-error" id="message-error"></p>
                </div>

                <div class="form-group honeypot" aria-hidden="true">
                  <label for="website">Website</label>
                  <input id="website" name="website" type="text" tabindex="-1" autocomplete="off" />
                </div>

                <p
                  class="form-status<?= $contactMessage !== '' ? ' is-visible is-' . orbita24_e($contactType) : '' ?>"
                  aria-live="polite"
                ><?= orbita24_e($contactMessage) ?></p>

                <button type="submit" class="btn btn-primary">Nachricht senden</button>
              </form>

              <p class="form-note">
                Mit dem Absenden stimmen Sie der Verarbeitung Ihrer Daten gemäß unserer
                <a href="datenschutz.html">Datenschutzerklärung</a>
                zu.
              </p>
            </article>
          </div>

          <aside class="card content-card kontakt-side-card" aria-labelledby="kontakt-direkt-title">
            <h2 id="kontakt-direkt-title">Direkter Kontakt</h2>
            <p class="kontakt-email">
              <a href="mailto:kontakt@orbita24.de">kontakt@orbita24.de</a>
            </p>
            <p>Schreiben Sie uns gerne per E-Mail. Wir melden uns so schnell wie möglich.</p>
            <p class="kontakt-side-note">
              Allgemeine Anfragen, Rückmeldungen und Hinweise sind jederzeit willkommen.
            </p>
          </aside>
        </div>
      </section>
    </main>

    <footer class="site-footer">
      <div class="container footer-grid">
        <div>
          <a href="index.html" class="logo footer-logo" aria-label="Orbita24 Startseite">
            <img src="images/logo-orbita24.svg" alt="Orbita24 Logo" class="logo-img" />
          </a>
          <p class="footer-text">
            Informationen und einfache Lösungen rund um verschiedene Dienstleistungen und Angebote.
          </p>
          <p class="footer-note">Unabhängige Informationen. Klar und verständlich aufbereitet.</p>
          <p class="footer-contact">
            <a href="mailto:kontakt@orbita24.de">kontakt@orbita24.de</a>
          </p>
        </div>

        <div class="footer-links">
          <div class="footer-link-group">
            <span>NAVIGATION</span>
            <a href="about.html">Über uns</a>
            <a href="kontakt.php">Kontakt</a>
          </div>
          <div class="footer-link-group">
            <span>RECHTLICHES</span>
            <a href="impressum.html">Impressum</a>
            <a href="datenschutz.html">Datenschutz</a>
          </div>
        </div>
      </div>
      <p class="footer-copy">© 2026 Orbita24. Alle Rechte vorbehalten.</p>
    </footer>

    <script src="js/script.js"></script>
  </body>
</html>
