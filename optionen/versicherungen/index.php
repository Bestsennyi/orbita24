<?php
$orbita24Root = dirname(__FILE__, 3);
require_once $orbita24Root . '/includes/site-functions.php';
orbita24_set_current_page('/optionen/versicherungen/');
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
            <h1>Versicherungen im &Uuml;berblick</h1>
            <p>Hier finden Sie passende Versicherungen f&uuml;r Ihren Alltag. Alle Bereiche finden Sie in unserer &Uuml;bersicht der <a href="/optionen/" class="structure-overview-link">Optionen</a>.</p>
          </div>

          <div class="structure-grid">
            <a href="/optionen/versicherungen/kfz-versicherung/" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128" fill="none">
                    <g
                      stroke="#ff5a1f"
                      stroke-width="6"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <path d="M40 82h-6c-4 0-7-3-7-7V64c0-4 3-6 6-7l18-3 10-16c2-3 4-4 8-4h19c4 0 7 3 8 6l8 14 6 2c4 1 6 4 6 8v11c0 4-3 7-7 7h-6" />
                      <circle cx="49" cy="82" r="8" />
                      <circle cx="94" cy="82" r="8" />
                      <path d="M57 82h29" />
                    </g>
                  </svg>
                </span>
                <span class="structure-card-meta">Auto</span>
              </span>
              <h3>KFZ-Versicherung</h3>
              <p>KFZ-Versicherungen einfach vergleichen.<br />Passenden Schutz f&uuml;r Ihr Auto finden.</p>
              <span class="btn btn-secondary">Optionen ansehen</span>
            </a>
            <a href="/optionen/versicherungen/haftpflichtversicherung/" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128" fill="none">
                    <g
                      stroke="#ff5a1f"
                      stroke-width="6"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <circle cx="64" cy="52" r="18" /><path d="M34 102c5-20 16-30 30-30s25 10 30 30" /><path d="M86 34l10-10" />
                    </g>
                  </svg>
                </span>
                <span class="structure-card-meta">Schutz</span>
              </span>
              <h3>Haftpflichtversicherung</h3>
              <p>Haftpflichtversicherungen &uuml;bersichtlich vergleichen.<br />Zuverl&auml;ssigen Schutz im Alltag w&auml;hlen.</p>
              <span class="btn btn-secondary">Optionen ansehen</span>
            </a>
            <a href="/optionen/versicherungen/hausratversicherung/" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128" fill="none">
                    <g
                      stroke="#ff5a1f"
                      stroke-width="6"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    >
                      <path d="M24 60l40-32 40 32" /><path d="M36 58v44h56V58" /><path d="M52 102V76h24v26" />
                    </g>
                  </svg>
                </span>
                <span class="structure-card-meta">Zuhause</span>
              </span>
              <h3>Hausratversicherung</h3>
              <p>Hausratversicherungen einfach vergleichen.<br />Pers&ouml;nliche Dinge zuverl&auml;ssig sch&uuml;tzen.</p>
              <span class="btn btn-secondary">Optionen ansehen</span>
            </a>
            <a href="/optionen/versicherungen/rechtsschutzversicherung/" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(3 3) scale(0.75)">
                      <path d="M12 3v18" />
                      <path d="m19 8 3 8a5 5 0 0 1-6 0zV7" />
                      <path d="M3 7h1a17 17 0 0 0 8-2 17 17 0 0 0 8 2h1" />
                      <path d="m5 8 3 8a5 5 0 0 1-6 0zV7" />
                      <path d="M7 21h10" />
                    </g>
                  </svg>
                </span>
                <span class="structure-card-meta">Recht</span>
              </span>
              <h3>Rechtsschutzversicherung</h3>
              <p>Rechtsschutzversicherungen gezielt vergleichen.<br />Bei Streitf&auml;llen finanziell abgesichert sein.</p>
              <span class="btn btn-secondary">Optionen ansehen</span>
            </a>
            <a href="/optionen/versicherungen/krankenkasse/" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(3 3) scale(0.75)">
                      <path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5" />
                    </g>
                  </svg>
                </span>
                <span class="structure-card-meta">Gesund</span>
              </span>
              <h3>Krankenkasse</h3>
              <p>Krankenkassen &uuml;bersichtlich vergleichen.<br />Passende Leistungen f&uuml;r Ihre Gesundheit finden.</p>
              <span class="btn btn-secondary">Optionen ansehen</span>
            </a>
            <a href="/optionen/versicherungen/berufsunfaehigkeitsversicherung/" class="card structure-card">
              <span class="structure-card-top">
                <span class="structure-card-icon" aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#ff5a1f" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <g transform="translate(3 3) scale(0.75)">
                      <path d="M14 21v-3a2 2 0 0 0-4 0v3" />
                      <path d="M18 4.933V21" />
                      <path d="m4 6 7.106-3.79a2 2 0 0 1 1.788 0L20 6" />
                      <path d="m6 11-3.52 2.147a1 1 0 0 0-.48.854V19a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-5a1 1 0 0 0-.48-.853L18 11" />
                      <path d="M6 4.933V21" />
                      <circle cx="12" cy="9" r="2" />
                    </g>
                  </svg>
                </span>
                <span class="structure-card-meta">Einkommen</span>
              </span>
              <h3>Berufsunf&auml;higkeitsversicherung</h3>
              <p>Berufsunf&auml;higkeit absichern und vergleichen.<br />Einkommen langfristig zuverl&auml;ssig sch&uuml;tzen.</p>
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
