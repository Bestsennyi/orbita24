<?php
$orbita24Root = dirname(__FILE__, 3);
require_once $orbita24Root . '/includes/site-functions.php';
orbita24_set_current_page('/optionen/internet/');
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
            <h1>Internet im &Uuml;berblick</h1>
            <p>Hier finden Sie passende Internetoptionen f&uuml;r Ihren Alltag. Alle Bereiche finden Sie in unserer &Uuml;bersicht der <a href="/optionen/" class="structure-overview-link">Optionen</a>.</p>
          </div>

          <div class="structure-grid">
            <a href="/optionen/internet/dsl/" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(3 3) scale(0.75)">
                      <rect width="20" height="8" x="2" y="14" rx="2" />
                      <path d="M6.01 18H6" />
                      <path d="M10.01 18H10" />
                      <path d="M15 10v4" />
                      <path d="M17.84 7.17a4 4 0 0 0-5.66 0" />
                      <path d="M20.66 4.34a8 8 0 0 0-11.31 0" />
                    </g>
                  </svg>
                </span>
                <span class="structure-card-meta">DSL</span>
              </span>
              <h3>DSL</h3>
              <p>DSL-Tarife einfach vergleichen.<br />Passenden Anschluss schnell finden.</p>
              <span class="btn btn-secondary">Optionen ansehen</span>
            </a>
            <a href="/optionen/internet/glasfaser/" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(3 3) scale(0.75)">
                      <path d="M2 13a2 2 0 0 0 2-2V7a2 2 0 0 1 4 0v13a2 2 0 0 0 4 0V4a2 2 0 0 1 4 0v13a2 2 0 0 0 4 0v-4a2 2 0 0 1 2-2" />
                    </g>
                  </svg>
                </span>
                <span class="structure-card-meta">Speed</span>
              </span>
              <h3>Glasfaser</h3>
              <p>Glasfaser-Tarife einfach pr&uuml;fen.<br />Hohe Geschwindigkeit zuverl&auml;ssig nutzen.</p>
              <span class="btn btn-secondary">Optionen ansehen</span>
            </a>
            <a href="/optionen/internet/mobilfunk/" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(3 3) scale(0.75)">
                      <rect width="14" height="20" x="5" y="2" rx="2" ry="2" />
                      <path d="M12 18h.01" />
                    </g>
                  </svg>
                </span>
                <span class="structure-card-meta">Mobil</span>
              </span>
              <h3>Mobilfunk</h3>
              <p>Mobilfunktarife &uuml;bersichtlich vergleichen.<br />Passenden Vertrag flexibel w&auml;hlen.</p>
              <span class="btn btn-secondary">Optionen ansehen</span>
            </a>
            <a href="/optionen/internet/sim/" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(3 3) scale(0.75)">
                      <path d="M12 2h6a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V10z" />
                      <path d="M12 2v6a2 2 0 0 1-2 2H4" />
                      <path d="M8 14h.01" />
                      <path d="M12 14h.01" />
                      <path d="M16 14h.01" />
                      <path d="M8 18h.01" />
                      <path d="M12 18h.01" />
                      <path d="M16 18h.01" />
                    </g>
                  </svg>
                </span>
                <span class="structure-card-meta">Flex</span>
              </span>
              <h3>SIM</h3>
              <p>SIM-Tarife gezielt vergleichen.<br />Flexibel und g&uuml;nstig mobil bleiben.</p>
              <span class="btn btn-secondary">Optionen ansehen</span>
            </a>
            <a href="/optionen/internet/festnetz/" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(3 3) scale(0.75)">
                      <path d="M9.5 13.866a4 4 0 0 1 5 .01" />
                      <path d="M12 17h.01" />
                      <path d="M3 10a2 2 0 0 1 .709-1.528l7-6a2 2 0 0 1 2.582 0l7 6A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                      <path d="M7 10.754a8 8 0 0 1 10 0" />
                    </g>
                  </svg>
                </span>
                <span class="structure-card-meta">Zuhause</span>
              </span>
              <h3>Festnetz</h3>
              <p>Internet f&uuml;r zuhause einfach w&auml;hlen.<br />Passende L&ouml;sung schnell finden.</p>
              <span class="btn btn-secondary">Optionen ansehen</span>
            </a>
            <a href="/optionen/internet/streaming/" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(3 3) scale(0.75)">
                      <rect width="20" height="15" x="2" y="7" rx="2" ry="2" />
                      <polyline points="17 2 12 7 7 2" />
                    </g>
                  </svg>
                </span>
                <span class="structure-card-meta">TV</span>
              </span>
              <h3>Streaming</h3>
              <p>Streaming-Angebote einfach ausw&auml;hlen.<br />Kosten und Pakete im Blick behalten.</p>
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
