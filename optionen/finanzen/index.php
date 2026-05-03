<?php
$orbita24Root = dirname(__FILE__, 3);
require_once $orbita24Root . '/includes/site-functions.php';
orbita24_set_current_page('/optionen/finanzen/');
?>
<!doctype html>
<html lang="de">
  <head>
    <?php include $orbita24Root . '/includes/head.php'; ?>
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="/css/optionen-structure.css" />
  </head>
  <body class="optionen-structure-page finanzen-page">
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
            <h1>Finanzen im &Uuml;berblick</h1>
            <p>Hier finden Sie passende Finanzl&ouml;sungen f&uuml;r Ihren Alltag. Alle Bereiche finden Sie in unserer &Uuml;bersicht der <a href="/optionen/" class="structure-overview-link">Optionen</a>.</p>
          </div>

          <div class="structure-grid">
            <a href="/optionen/finanzen/kredit/" class="card structure-card">
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
                <span class="structure-card-meta">&Uuml;berblick</span>
              </span>
              <h3>Kredit</h3>
              <p>Kreditangebote einfach ansehen.<br />Passende Finanzierung f&uuml;r Ihre Situation finden.</p>
              <span class="btn btn-secondary">Optionen ansehen</span>
            </a>
            <a href="/optionen/finanzen/girokonto/" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(3 3) scale(0.75)">
                      <path d="M10 18v-7" />
                      <path d="M11.12 2.198a2 2 0 0 1 1.76.006l7.866 3.847c.476.233.31.949-.22.949H3.474c-.53 0-.695-.716-.22-.949z" />
                      <path d="M14 18v-7" />
                      <path d="M18 18v-7" />
                      <path d="M3 22h18" />
                      <path d="M6 18v-7" />
                    </g>
                  </svg>
                </span>
                <span class="structure-card-meta">Alltag</span>
              </span>
              <h3>Girokonto</h3>
              <p>Girokonten &uuml;bersichtlich ansehen.<br />Passendes Konto f&uuml;r den Alltag w&auml;hlen.</p>
              <span class="btn btn-secondary">Optionen ansehen</span>
            </a>
            <a href="/optionen/finanzen/kreditkarte/" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(3 3) scale(0.75)">
                      <rect width="20" height="14" x="2" y="5" rx="2" />
                      <line x1="2" x2="22" y1="10" y2="10" />
                    </g>
                  </svg>
                </span>
                <span class="structure-card-meta">Karten</span>
              </span>
              <h3>Kreditkarte</h3>
              <p>Kreditkarten einfach ansehen.<br />Passende Karte f&uuml;r Alltag und Reisen finden.</p>
              <span class="btn btn-secondary">Optionen ansehen</span>
            </a>
            <a href="/optionen/finanzen/tagesgeld/" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(3 3) scale(0.75)">
                      <path d="M16 7h6v6" />
                      <path d="m22 7-8.5 8.5-5-5L2 17" />
                    </g>
                  </svg>
                </span>
                <span class="structure-card-meta">Sparen</span>
              </span>
              <h3>Tagesgeld</h3>
              <p>Tagesgeld Zinsen einfach ansehen.<br />Flexibel und sicher Geld anlegen.</p>
              <span class="btn btn-secondary">Optionen ansehen</span>
            </a>
            <a href="/optionen/finanzen/festgeld/" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(3 3) scale(0.75)">
                      <rect width="18" height="11" x="3" y="11" rx="2" ry="2" />
                      <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    </g>
                  </svg>
                </span>
                <span class="structure-card-meta">Stabil</span>
              </span>
              <h3>Festgeld</h3>
              <p>Festgeld Angebote gezielt ansehen.<br />Kapital sicher mit festen Zinsen anlegen.</p>
              <span class="btn btn-secondary">Optionen ansehen</span>
            </a>
            <a href="/optionen/finanzen/kredit-trotz-schufa/" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(3 3) scale(0.75)">
                      <path d="M21 10.656V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h12.344" />
                      <path d="m9 11 3 3L22 4" />
                    </g>
                  </svg>
                </span>
                <span class="structure-card-meta">Bonit&auml;t</span>
              </span>
              <h3>Kredit trotz Schufa</h3>
              <p>Kredit trotz Schufa einfach pr&uuml;fen.<br />Passende Anbieter auch bei schw&auml;cherer Bonit&auml;t finden.</p>
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
