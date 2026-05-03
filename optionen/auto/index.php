<?php
$orbita24Root = dirname(__FILE__, 3);
require_once $orbita24Root . '/includes/site-functions.php';
orbita24_set_current_page('/optionen/auto/');
?>
<!doctype html>
<html lang="de">
  <head>
    <?php include $orbita24Root . '/includes/head.php'; ?>
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="/css/optionen-structure.css" />
  </head>
  <body class="optionen-structure-page">
    <div class="site-bg" aria-hidden="true"></div>
    <?php include $orbita24Root . '/includes/header.php'; ?>

    <main>
      <section class="section structure-section">
        <div class="container structure-container">
                    <div class="structure-nav-row">
            <a href="/optionen/" class="structure-back" aria-label="Zur&uuml;ck zu Optionen">
              <span class="structure-back-arrow" aria-hidden="true">&larr;</span>
            </a>
            <?php orbita24_render_breadcrumbs(); ?>
          </div><div class="structure-header">
            <h1>Auto im &Uuml;berblick</h1>
            <p>Passende Anbieter und Angebote rund ums Auto ansehen. Alle Bereiche finden Sie in unserer &Uuml;bersicht der <a href="/optionen/" class="structure-overview-link">Optionen</a>.</p>
          </div>

          <div class="structure-grid">
            <a href="/optionen/auto/autokredit/" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(3 3) scale(0.75)">
                      <rect width="20" height="12" x="2" y="6" rx="2" />
                      <circle cx="12" cy="12" r="2" />
                      <path d="M6 12h.01M18 12h.01" />
                    </g>
                  </svg>
                </span>
                <span class="structure-card-meta">Kredit</span>
              </span>
              <h3>Autokredit</h3>
              <p class="structure-card-description"><span>Autokredit einfach ansehen.</span><span>Fahrzeug flexibel finanzieren.</span></p>
              <span class="btn btn-secondary">Optionen ansehen</span>
            </a>
            <a href="/optionen/auto/leasing/" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(3 3) scale(0.75)">
                      <path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526" />
                      <circle cx="12" cy="8" r="6" />
                    </g>
                  </svg>
                </span>
                <span class="structure-card-meta">Leasing</span>
              </span>
              <h3>Leasing</h3>
              <p class="structure-card-description"><span>Leasingangebote ansehen.</span><span>Flexibel und planbar fahren.</span></p>
              <span class="btn btn-secondary">Optionen ansehen</span>
            </a>
            <a href="/optionen/auto/zulassung/" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(3 3) scale(0.75)">
                      <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7z" />
                      <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                      <path d="M10 9H8" />
                      <path d="M16 13H8" />
                      <path d="M16 17H8" />
                    </g>
                  </svg>
                </span>
                <span class="structure-card-meta">Anmeldung</span>
              </span>
              <h3>Zulassung</h3>
              <p class="structure-card-description"><span>Auto einfach zulassen.</span><span>Schnell und sicher anmelden.</span></p>
              <span class="btn btn-secondary">Optionen ansehen</span>
            </a>
            <a href="/optionen/auto/gebrauchtwagen/" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(3 3) scale(0.75)">
                      <path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2" />
                      <circle cx="7" cy="17" r="2" />
                      <path d="M9 17h6" />
                      <circle cx="17" cy="17" r="2" />
                    </g>
                  </svg>
                </span>
                <span class="structure-card-meta">Gebraucht</span>
              </span>
              <h3>Gebrauchtwagen</h3>
              <p class="structure-card-description"><span>Gebrauchtwagen gezielt ansehen.</span><span>Passendes Fahrzeug schnell finden.</span></p>
              <span class="btn btn-secondary">Optionen ansehen</span>
            </a>
            <a href="/optionen/auto/neuwagen/" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(3 3) scale(0.75)">
                      <path d="m21 8-2 2-1.5-3.7A2 2 0 0 0 15.646 5H8.4a2 2 0 0 0-1.903 1.257L5 10 3 8" />
                      <path d="M7 14h.01" />
                      <path d="M17 14h.01" />
                      <rect width="18" height="8" x="3" y="10" rx="2" />
                      <path d="M5 18v2" />
                      <path d="M19 18v2" />
                    </g>
                  </svg>
                </span>
                <span class="structure-card-meta">Neu</span>
              </span>
              <h3>Neuwagen</h3>
              <p class="structure-card-description"><span>Neuwagen einfach ansehen.</span><span>Passendes Modell direkt finden.</span></p>
              <span class="btn btn-secondary">Optionen ansehen</span>
            </a>
            <a href="/optionen/auto/elektroauto/" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(3 3) scale(0.75)">
                      <path d="M14 13h2a2 2 0 0 1 2 2v2a2 2 0 0 0 4 0v-6.998a2 2 0 0 0-.59-1.42L18 5" />
                      <path d="M14 21V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v16" />
                      <path d="M2 21h13" />
                      <path d="M3 7h11" />
                      <path d="m9 11-2 3h3l-2 3" />
                    </g>
                  </svg>
                </span>
                <span class="structure-card-meta">E-Auto</span>
              </span>
              <h3>Elektroauto</h3>
              <p class="structure-card-description"><span>Elektroautos einfach ansehen.</span><span>Vorteile und F&ouml;rderung nutzen.</span></p>
              <span class="btn btn-secondary">Optionen ansehen</span>
            </a>
          </div>

          <article class="card structure-final">
            <div>
              <h2>Passende Optionen entdecken</h2>
              <p>W&auml;hlen Sie ein Thema und entdecken Sie die n&auml;chsten Schritte in Ruhe.</p>
            </div>
            <div class="cta-side">
              <a href="/kontakt.php" class="btn btn-primary">Kontakt aufnehmen</a>
            </div>
          </article>
        </div>
      </section>
</main>
    <?php include $orbita24Root . '/includes/footer.php'; ?>
    <?php include $orbita24Root . '/includes/scripts.php'; ?>
  </body>
</html>
