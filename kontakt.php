<?php
declare(strict_types=1);

require __DIR__ . '/includes/contact-handler.php';

$contactState = orbita24_handle_contact_request();
$contactType = is_string($contactState['type'] ?? null) ? $contactState['type'] : '';
$contactMessage = is_string($contactState['message'] ?? null) ? $contactState['message'] : '';
$oldInput = is_array($contactState['old'] ?? null) ? $contactState['old'] : [];
$contactEvents = is_array($contactState['events'] ?? null) ? $contactState['events'] : [];
$csrfToken = is_string($contactState['csrf_token'] ?? null) ? $contactState['csrf_token'] : '';
$oldName = is_string($oldInput['name'] ?? null) ? $oldInput['name'] : '';
$oldEmail = is_string($oldInput['email'] ?? null) ? $oldInput['email'] : '';
$oldMessage = is_string($oldInput['message'] ?? null) ? $oldInput['message'] : '';
$formStatusClass = 'form-status';

if ($contactMessage !== '') {
    $formStatusClass .= ' is-visible is-' . $contactType;
}

$csrfTokenHtml = orbita24_e($csrfToken);
$oldNameHtml = orbita24_e($oldName);
$oldEmailHtml = orbita24_e($oldEmail);
$oldMessageHtml = orbita24_e($oldMessage);
$formStatusClassHtml = orbita24_e($formStatusClass);
$contactMessageHtml = orbita24_e($contactMessage);
$csrfTokenFieldHtml = '<input type="hidden" name="csrf_token" value="' . $csrfTokenHtml . '" />';
$nameInputHtml = '<input id="name" name="name" type="text" autocomplete="name" maxlength="120" value="' . $oldNameHtml . '" required aria-describedby="name-error" />';
$emailInputHtml = '<input id="email" name="email" type="email" autocomplete="email" maxlength="190" value="' . $oldEmailHtml . '" required aria-describedby="email-error" />';
$messageTextareaHtml = '<textarea id="message" name="message" rows="3" maxlength="5000" required aria-describedby="message-error">' . $oldMessageHtml . '</textarea>';
$formStatusHtml = '<p class="' . $formStatusClassHtml . '" aria-live="polite">' . $contactMessageHtml . '</p>';
$shouldPushContactFormSubmit = in_array('contact_form_submit', $contactEvents, true);
?>
<!doctype html>
<html lang="de">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://consent.cookiebot.com" />
    <link rel="preconnect" href="https://consentcdn.cookiebot.com" />
<script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('consent', 'default', {
        'ad_storage': 'denied',
        'ad_user_data': 'denied',
        'ad_personalization': 'denied',
        'analytics_storage': 'denied',
        'wait_for_update': 500
      });
    </script>
    <script
      id="Cookiebot"
      src="https://consent.cookiebot.com/uc.js"
      data-cbid="2442c9f2-b102-489d-b183-906d466fc319"
      data-culture="DE"
      type="text/javascript"
      async
    ></script>
    <!-- Google Tag Manager -->
    <script>
      (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});
      var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';
      j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;
      f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-5HL9LFK4');
    </script>
    <!-- End Google Tag Manager -->
    <title>Orbita24 Kontakt: Fragen zu Angeboten &amp; Vergleichen</title>
    <meta name="description" content="Kontaktieren Sie Orbita24 bei Fragen zu Angeboten, Anbietern oder Vergleichen. Wir helfen Ihnen klar, schnell und verst&#228;ndlich bei Ihrem Anliegen weiter." />
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
  <body class="page-sticky kontakt-page">
    <!-- Google Tag Manager (noscript) -->
    <noscript>
      <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5HL9LFK4"
      height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="site-bg" aria-hidden="true"></div>

    <header class="site-header">
      <div class="container nav">
        <a href="index.html" class="logo" aria-label="Orbita24 Startseite">
          <img src="images/logo-orbita24.svg" alt="Orbita24 Logo" class="logo-img" width="1991" height="390" decoding="async" />
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

        <a href="optionen.html" class="btn btn-primary nav-cta cta-all-options" data-location="header">Alle Optionen ansehen</a>
      </div>
    </header>

    <main>
      <section class="section page-section">
        <div class="container kontakt-layout">
          <div class="kontakt-main">
            <div class="page-header">
              <p class="eyebrow">KONTAKT</p>
              <h1>Schreiben Sie uns</h1>
              <p>Bei Fragen uns einfach kontaktieren.</p>
            </div>

            <article class="card form-card kontakt-form-card">
              <p class="form-intro">
                Schreiben Sie uns einfach eine Nachricht - wir melden uns so schnell wie möglich.
              </p>

              <form class="contact-form kontakt-form" action="kontakt.php" method="post" accept-charset="UTF-8">
                <?php echo $csrfTokenFieldHtml; ?>

                <div class="form-group">
                  <label for="name">Name</label>
                  <?php echo $nameInputHtml; ?>
                  <p class="field-error" id="name-error"></p>
                </div>

                <div class="form-group">
                  <label for="email">E-Mail</label>
                  <?php echo $emailInputHtml; ?>
                  <p class="field-error" id="email-error"></p>
                </div>

                <div class="form-group">
                  <label for="message">Nachricht</label>
                  <?php echo $messageTextareaHtml; ?>
                  <p class="field-error" id="message-error"></p>
                </div>

                <div class="form-group honeypot" aria-hidden="true">
                  <label for="website">Website</label>
                  <input id="website" name="website" type="text" tabindex="-1" autocomplete="off" />
                </div>

                <?php echo $formStatusHtml; ?>

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
            <img src="images/logo-orbita24.svg" alt="Orbita24 Logo" class="logo-img" width="1991" height="390" loading="lazy" decoding="async" />
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
            <a href="cookies.html">Cookies</a>
          </div>
        </div>
      </div>
      <p class="footer-copy">© 2026 Orbita24. Alle Rechte vorbehalten.</p>
    </footer>

    <script src="js/script.js"></script>
  </body>
</html>
