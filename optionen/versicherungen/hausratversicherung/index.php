<?php
$orbita24Root = dirname(__FILE__, 4);
require_once $orbita24Root . '/includes/site-functions.php';
orbita24_set_current_page('/optionen/versicherungen/hausratversicherung/');
?>
<!doctype html>
<html lang="de">
  <head>
    <?php include $orbita24Root . '/includes/head.php'; ?>
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="/css/optionen-structure.css" />
    <style>
      .offer-intro {
        margin-bottom: 22px;
      }

      .offer-intro h1 {
        margin-bottom: 8px;
      }

      .offer-intro p {
        max-width: 640px;
        line-height: 1.48;
      }

      .offer-intro.structure-header {
        max-width: 680px;
      }

      .structure-nav-row {
        margin-bottom: 20px;
      }

      .offer-grid {
        display: grid;
        gap: 20px;
        margin-bottom: 35px;
      }

      .offer-card {
        position: relative;
        min-height: 100%;
        padding: 24px;
        display: flex;
        flex-direction: column;
        background: #ffffff;
      }

      .offer-logo {
        width: 142px;
        max-width: 52%;
        min-height: 58px;
        padding: 10px 18px;
        margin-top: -6px;
        margin-bottom: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(17, 24, 39, 0.1);
        border-radius: 8px;
        color: rgba(75, 85, 99, 0.72);
        background: rgba(248, 250, 252, 0.96);
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        box-sizing: border-box;
      }

      .offer-card .structure-card-meta {
        position: absolute;
        top: 18px;
        right: 18px;
        max-width: calc(100% - 176px);
        margin: 0;
      }

      .offer-card h2 {
        margin: 0 0 10px;
        color: var(--text-strong);
        font-size: clamp(1.25rem, 2vw, 1.45rem);
        line-height: 1.18;
      }

      .offer-card p {
        margin: 0 0 18px;
        color: var(--muted);
        line-height: 1.5;
      }

      .offer-card ul {
        margin: 0 0 22px;
        padding: 0;
        list-style: none;
        display: grid;
        gap: 10px;
      }

      .offer-card li {
        color: #4b5563;
        font-size: 0.95rem;
        line-height: 1.35;
      }

      .offer-card li::before {
        content: "\2713";
        margin-right: 8px;
        color: #1f7a5a;
        font-weight: 700;
      }

      .offer-card .btn {
        width: 100%;
        margin-top: auto;
        color: #ff5a1f;
        background: #ffffff;
        border-color: rgba(17, 24, 39, 0.14);
        box-shadow: none;
      }

      .offer-card .btn:hover,
      .offer-card .btn:focus-visible {
        color: #ffffff;
        background: #ff5a1f;
        border-color: #ff5a1f;
        box-shadow:
          0 10px 24px rgba(255, 90, 31, 0.12),
          var(--glow-orange);
      }

      .offer-card .btn:active {
        color: #ffffff;
        background: #e04a17;
        border-color: #e04a17;
      }

      @media (min-width: 768px) {
        .offer-grid {
          grid-template-columns: repeat(3, minmax(0, 1fr));
        }
      }

      @media (max-width: 767px) {
        .offer-card {
          padding: 22px;
        }
      }
    </style>
  </head>
  <body class="optionen-structure-page">
    <div class="site-bg" aria-hidden="true"></div>
    <?php include $orbita24Root . '/includes/header.php'; ?>

    <main>
      <section class="section structure-section">
        <div class="container structure-container">
                    <div class="structure-nav-row">
            <a href="/optionen/versicherungen/" class="structure-back" aria-label="Zur&uuml;ck zu Versicherungen">
              <span class="structure-back-arrow" aria-hidden="true">&larr;</span>
            </a>
            <?php orbita24_render_breadcrumbs(); ?>
          </div>

          <div class="structure-header offer-intro">
            <h1>Hausratversicherung einfach erkl&auml;rt</h1>
            <p>Hier finden Sie passende Hausratversicherungen f&uuml;r Ihr Zuhause.</p>
          </div>

          <div class="offer-grid" aria-label="Empfohlene Optionen">
            <article class="card offer-card">
              <div class="offer-logo" aria-hidden="true">Logo</div>
              <span class="structure-card-meta">Einstieg</span>
              <h2>Hausratversicherung f&uuml;r den Alltag</h2>
              <p>Sch&uuml;tzen Sie M&ouml;bel, Ger&auml;te und pers&ouml;nliche Dinge einfach und &uuml;bersichtlich.</p>
              <ul>
                <li>&Uuml;bersichtlicher Ablauf</li>
                <li>Klare Struktur</li>
                <li>F&uuml;r viele Situationen geeignet</li>
              </ul>
              <a href="/kontakt.php" class="btn offer-cta" data-offer="true">Zum Angebot</a>
            </article>

            <article class="card offer-card">
              <div class="offer-logo" aria-hidden="true">Logo</div>
              <span class="structure-card-meta">Flexibel</span>
              <h2>Flexible Versicherung</h2>
              <p>Tarife flexibel an Wohnsituation und individuellen Bedarf anpassen.</p>
              <ul>
                <li>Anpassbare M&ouml;glichkeiten</li>
                <li>Mehr Spielraum</li>
                <li>Individuelle Ausrichtung</li>
              </ul>
              <a href="/kontakt.php" class="btn offer-cta" data-offer="true">Zum Angebot</a>
            </article>

            <article class="card offer-card">
              <div class="offer-logo" aria-hidden="true">Logo</div>
              <span class="structure-card-meta">Schnell</span>
              <h2>Schnell</h2>
              <p>Schnell ansehen, abschlie&szlig;en und Ihr Zuhause zuverl&auml;ssig absichern.</p>
              <ul>
                <li>Schneller Einstieg</li>
                <li>Kurzer Ablauf</li>
                <li>Direkt online m&ouml;glich</li>
              </ul>
              <a href="/kontakt.php" class="btn offer-cta" data-offer="true">Zum Angebot</a>
            </article>
          </div>
        <?php orbita24_render_related_topics(); ?>

          <article class="card structure-final">
            <div>
              <h2>Weitere Optionen entdecken</h2>
            <p>
              Sehen Sie sich weitere M&ouml;glichkeiten an und finden Sie in Ruhe, was zu
              Ihrer Situation passt.
            </p>
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
