<?php
$orbita24Root = dirname(__FILE__, 1);
require_once $orbita24Root . '/includes/site-functions.php';
orbita24_set_current_page('/');
?>
<!doctype html>
<html lang="de">
  <head>
    <?php include $orbita24Root . '/includes/head.php'; ?>
    <style>
      :root {
        --header-height: 80px;
        --accent: #ff5a1f;
      }

      *,
      *::before,
      *::after {
        box-sizing: border-box;
      }

      html {
        scrollbar-gutter: stable;
        overflow-y: scroll;
      }

      body {
        margin: 0;
        font-family: Inter, Arial, Helvetica, sans-serif;
        color: #f9fafb;
        background: #111827;
      }

      img {
        display: block;
        max-width: 100%;
        height: auto;
      }

      a {
        color: inherit;
        text-decoration: none;
      }

      .container {
        width: min(100% - 32px, 1210px);
        margin: 0 auto;
      }

      .site-header {
        position: sticky;
        top: 0;
        z-index: 50;
        background: #111827;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
      }

      .nav {
        width: min(100% - 32px, 1210px);
        min-height: var(--header-height);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
      }

      .logo,
      .btn {
        display: inline-flex;
        align-items: center;
      }

      .logo-img {
        width: auto;
        height: 37px;
      }

      .nav-toggle {
        width: 44px;
        height: 44px;
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 5px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.025);
      }

      .nav-toggle span {
        width: 18px;
        height: 2px;
        border-radius: 999px;
        background: #f9fafb;
      }

      .nav-toggle[aria-expanded="true"] span:nth-child(1) {
        transform: translateY(7px) rotate(45deg);
      }

      .nav-toggle[aria-expanded="true"] span:nth-child(2) {
        opacity: 0;
      }

      .nav-toggle[aria-expanded="true"] span:nth-child(3) {
        transform: translateY(-7px) rotate(-45deg);
      }

      .nav-menu,
      .nav-cta {
        display: none;
      }

      .site-header a,
      .site-header button {
        -webkit-tap-highlight-color: transparent;
      }

      .site-header a:focus,
      .site-header a:active,
      .site-header button:focus,
      .site-header button:active {
        outline: 0;
        box-shadow: none;
      }

      .site-header .btn:active,
      .site-header .btn:focus-visible,
      .site-header .btn:hover {
        transform: none;
        box-shadow: none;
      }

      .site-header .btn-primary:hover,
      .site-header .btn-primary:focus-visible,
      .site-header .btn-primary:active {
        color: #ffffff;
        background: var(--accent);
        border-color: transparent;
        box-shadow: none;
      }

      .site-header .logo,
      .site-header .nav-menu a,
      .site-header .nav-cta {
        transition: none;
      }

      .site-header .nav-cta.is-optionen-active {
        width: auto;
        min-height: auto;
        margin-left: -12px;
        padding: 10px 14px;
        color: #ffffff;
        background: transparent;
        border-color: transparent;
        border-radius: 12px;
        box-shadow: none;
        font-size: inherit;
        font-weight: inherit;
        line-height: inherit;
        text-decoration: underline;
        text-decoration-color: rgba(255, 255, 255, 0.55);
        text-underline-offset: 5px;
        cursor: default;
      }

      .site-header .nav-cta.is-optionen-active:hover,
      .site-header .nav-cta.is-optionen-active:focus-visible,
      .site-header .nav-cta.is-optionen-active:active {
        color: #ffffff;
        background: transparent;
        border-color: transparent;
        box-shadow: none;
        transform: none;
      }

      body.is-navigating .site-header *,
      body.is-navigating .site-header *::before,
      body.is-navigating .site-header *::after {
        transition: none !important;
        animation: none !important;
        transform: none !important;
        outline: 0 !important;
        box-shadow: none !important;
      }

      .hero {
        --hero-block-size: clamp(27.5rem, 58svh, 38.75rem);
        position: relative;
        min-height: var(--hero-block-size);
        overflow: hidden;
        color: #f9fafb;
      }

      .hero-media,
      .hero-media-overlay {
        position: absolute;
        inset: 0;
      }

      .hero-media {
        z-index: 0;
      }

      .hero-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: 84% center;
      }

      .hero-media-overlay {
        background:
          linear-gradient(
            90deg,
            rgba(17, 24, 39, 0.96) 0%,
            rgba(17, 24, 39, 0.84) 21%,
            rgba(17, 24, 39, 0.62) 44%,
            rgba(17, 24, 39, 0.34) 72%,
            rgba(17, 24, 39, 0.14) 100%
          ),
          linear-gradient(
            180deg,
            rgba(17, 24, 39, 0.12) 0%,
            rgba(17, 24, 39, 0.2) 100%
          );
      }

      .hero .container {
        position: relative;
        z-index: 2;
      }

      .hero-shell {
        min-height: var(--hero-block-size);
        display: grid;
        align-items: center;
        justify-items: start;
        padding: 56px 0 48px;
      }

      .hero-content {
        width: min(100%, 560px);
        display: grid;
        align-content: center;
      }

      .eyebrow {
        margin: 0 0 14px;
        color: #00ff88;
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
      }

      .hero-content h1 {
        max-width: 10.4ch;
        margin: 0 0 22px;
        font-size: clamp(2.18rem, 3.8vw, 3.55rem);
        font-weight: 800;
        line-height: 1.04;
        letter-spacing: 0;
      }

      .hero-text {
        max-width: 560px;
        margin: 0;
        color: #c4ccd7;
        font-size: 1.06rem;
        line-height: 1.6;
      }

      .hero-cta-mobile {
        display: none;
      }

      .hero-trust {
        margin: 34px 0 0;
        padding: 0;
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 12px;
      }

      .hero-trust li {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.02rem;
        font-weight: 600;
      }

      .hero-trust-icon,
      .hero-trust-icon svg {
        width: 18px;
        height: 18px;
      }

      @media (max-width: 767px) {
        .site-header .logo-img {
          height: 32px;
        }

        .hero {
          min-height: clamp(560px, 90dvh, 680px);
          display: flex;
          align-items: center;
          padding-top: 44px;
          padding-bottom: 48px;
          text-align: center;
        }

        .hero-img {
          object-position: 70% center;
        }

        .hero-media-overlay {
          background:
            linear-gradient(
              180deg,
              rgba(17, 24, 39, 0.48) 0%,
              rgba(17, 24, 39, 0.34) 100%
            ),
            linear-gradient(
              90deg,
              rgba(17, 24, 39, 0.8) 0%,
              rgba(17, 24, 39, 0.56) 50%,
              rgba(17, 24, 39, 0.18) 100%
            );
        }

        .hero-shell {
          min-height: auto;
          justify-items: center;
          padding: 0;
        }

        .hero-content {
          width: 100%;
          max-width: 400px;
          margin: 0 auto;
          justify-items: center;
        }

        .hero-content h1 {
          max-width: 100%;
          margin-bottom: 20px;
          font-size: clamp(1.86rem, 7.9vw, 2.38rem);
          line-height: 1.08;
        }

        .hero-text {
          max-width: 370px;
          margin: 0 auto 16px;
          font-size: 0.9rem;
          line-height: 1.5;
        }

        .hero-cta-mobile {
          width: 100%;
          max-width: 360px;
          min-height: 48px;
          margin: 20px auto 0;
          display: inline-flex;
          align-items: center;
          justify-content: center;
          border-radius: 14px;
          background: var(--accent);
          color: #ffffff;
          font-weight: 800;
        }

        .hero-trust {
          width: max-content;
          max-width: 100%;
          margin: 17px auto 17px;
          gap: 10px;
          text-align: left;
        }

        .hero-trust li {
          font-size: 0.98rem;
        }
      }

      @media (min-width: 768px) {
        .hero {
          --hero-block-size: clamp(23.75rem, 48svh, 31.75rem);
        }

        .hero-img {
          object-position: 80% center;
        }

        .hero-shell {
          padding: 37px 0 30px;
        }

        .hero-content {
          width: min(100%, 620px);
        }

        .hero-content h1 {
          max-width: 11.6ch;
          font-size: clamp(2.65rem, 5.2vw, 3.2rem);
        }

        .hero-text {
          max-width: 380px;
          font-size: 1.08rem;
          line-height: 1.55;
        }
      }

      @media (min-width: 1025px) {
        .nav-toggle {
          display: none;
        }

        .nav-menu {
          display: flex;
          align-items: center;
          gap: 4px;
          margin-left: auto;
        }

        .nav-menu a {
          padding: 10px 14px;
          margin: 0;
          font-size: 1rem;
          line-height: 1.25;
          border: 0;
          outline: 0;
        }

        .nav-menu a.is-optionen-active {
          padding: 10px 14px;
          margin: 0;
          font-size: 1rem;
          line-height: 1.25;
        }

        .nav-menu a:hover,
        .nav-menu a:focus-visible,
        .nav-menu a:active {
          outline: 0;
          box-shadow: none;
        }

        .nav-menu a.nav-mobile-only {
          display: none;
        }

        .nav-cta {
          min-height: 48px;
          margin-left: 4px;
          padding: 0 20px;
          display: inline-flex;
          justify-content: center;
          border-radius: 14px;
          background: var(--accent);
          color: #ffffff;
          font-size: 1rem;
          font-weight: 700;
          line-height: 1.25;
        }

        .site-header .nav-cta.is-optionen-active {
          margin-left: -12px;
        }

        .hero {
          --hero-block-size: 35rem;
        }

        .hero-img {
          object-position: 82% center;
        }

        .hero-shell {
          padding: 42px 0 52px;
        }

        .hero-content {
          width: min(100%, 640px);
        }

        .hero-content h1 {
          max-width: 11.4ch;
          font-size: clamp(3rem, 4vw, 3.65rem);
        }

        .hero-text {
          max-width: 380px;
          font-size: 1.06rem;
        }
      }

      @media (min-width: 1200px) {
        .hero-img {
          object-position: 84% center;
        }

        .hero-shell {
          padding: 44px 0 38px;
        }

        .hero-content {
          width: min(100%, 820px);
        }

        .hero-content h1 {
          max-width: 12.4ch;
          font-size: clamp(3.85rem, 4.4vw, 4.45rem);
        }

        .hero-text {
          max-width: 430px;
          font-size: 1.16rem;
        }
      }

      @media (min-width: 1400px) {
        .hero {
          --hero-block-size: min(calc(100svh - var(--header-height)), 54rem);
        }

        .hero-content h1 {
          font-size: clamp(3.8rem, 4.2vw, 4.7rem);
        }

        .hero-text {
          font-size: 1rem;
          line-height: 1.7;
        }
      }
    </style>
    <link rel="stylesheet" href="/css/style.css" />
    <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "Orbita24",
        "url": "https://orbita24.de"
      }
    </script>
  </head>
  <body>
    <div class="site-bg" aria-hidden="true"></div>
    <?php include $orbita24Root . '/includes/header.php'; ?>

    <main>
      <section class="hero section">
        <div class="hero-media" aria-hidden="true">
          <img
            src="/images/hero-bg.webp"
            alt=""
            class="hero-img"
            width="1920"
            height="1080"
            loading="eager"
            fetchpriority="high"
            decoding="async"
          />
          <div class="hero-media-overlay"></div>
        </div>

        <div class="container">
          <div class="hero-shell">
            <div class="hero-content">
              <p class="eyebrow">Einfache und klare L&ouml;sungen</p>

              <h1>Finden Sie schnell die passende L&ouml;sung</h1>

              <p class="hero-text">
                Wir zeigen Ihnen ausgew&auml;hlte Angebote &uuml;bersichtlich
                und verst&auml;ndlich. Vergleichen Sie Optionen einfach und
                treffen Sie die passende Entscheidung. Klar, unabh&auml;ngig und
                verst&auml;ndlich erkl&auml;rt.
              </p>

              <a
                href="/optionen/"
                class="btn btn-primary hero-cta cta-all-options"
                data-location="hero"
                >Alle Optionen ansehen</a
              >

              <ul class="hero-trust">
                <li>
                  <span class="hero-trust-icon" aria-hidden="true">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 128 128"
                      fill="none"
                    >
                      <g
                        stroke="#00ff88"
                        stroke-width="8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path d="M28 66l22 22 50-50" />
                      </g>
                    </svg>
                  </span>
                  <span>Klar erkl&auml;rt</span>
                </li>
                <li>
                  <span class="hero-trust-icon" aria-hidden="true">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 128 128"
                      fill="none"
                    >
                      <g
                        stroke="#00ff88"
                        stroke-width="8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <rect x="24" y="24" width="80" height="80" rx="14" />
                        <path d="M44 54h40" />
                        <path d="M44 74h40" />
                      </g>
                    </svg>
                  </span>
                  <span>&Uuml;bersichtlich aufgebaut</span>
                </li>
                <li>
                  <span class="hero-trust-icon" aria-hidden="true">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 128 128"
                      fill="none"
                    >
                      <g
                        stroke="#00ff88"
                        stroke-width="8"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                      >
                        <path d="M24 64h64" />
                        <path d="M72 40l32 24-32 24" />
                      </g>
                    </svg>
                  </span>
                  <span>Direkt zum Wesentlichen</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </section>
      <section id="leistungen" class="section">
        <div class="container">
          <div class="section-heading">
            <p class="eyebrow">Unser Angebot</p>
            <h2>&Uuml;bersichtliche Informationen und passende Optionen</h2>
            <p>
              Wir bereiten Inhalte verst&auml;ndlich auf, damit Sie sich schnell
              orientieren und
              <a href="/optionen/">Optionen</a> leichter vergleichen
              k&ouml;nnen.
            </p>
          </div>

          <div class="cards-grid">
            <article class="card feature-card">
              <div class="icon" aria-hidden="true">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="#ff5a1f"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <g transform="translate(2.4 2.4) scale(0.8)">
                    <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
                    <path
                      d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"
                    />
                    <path d="m9 14 2 2 4-4" />
                  </g>
                </svg>
              </div>
              <h3>Klar aufbereitete Inhalte</h3>
              <p>
                Wichtige Informationen sind &uuml;bersichtlich dargestellt,
                damit Sie schnell erfassen, worauf es ankommt.
              </p>
            </article>

            <article class="card feature-card">
              <div class="icon" aria-hidden="true">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="#ff5a1f"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <g transform="translate(3 3) scale(0.75)">
                    <path
                      d="M10 20a1 1 0 0 0 .553.895l2 1A1 1 0 0 0 14 21v-7a2 2 0 0 1 .517-1.341L21.74 4.67A1 1 0 0 0 21 3H3a1 1 0 0 0-.742 1.67l7.225 7.989A2 2 0 0 1 10 14z"
                    />
                  </g>
                </svg>
              </div>
              <h3>Ausgew&auml;hlte Angebote</h3>
              <p>
                Angebote aus verschiedenen Bereichen werden &uuml;bersichtlich
                dargestellt und lassen sich leichter vergleichen.
              </p>
            </article>

            <article class="card feature-card">
              <div class="icon" aria-hidden="true">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="#ff5a1f"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <g transform="translate(3 3) scale(0.75)">
                    <path
                      d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719"
                    />
                    <path d="m9 12 2 2 4-4" />
                  </g>
                </svg>
              </div>
              <h3>Einfacher Kontakt</h3>
              <p>
                Bei offenen Fragen finden Sie schnell den passenden
                n&auml;chsten Schritt.
              </p>
            </article>
          </div>
        </div>
      </section>

      <section class="section">
        <div class="container">
          <div class="section-heading">
            <p class="eyebrow">Warum Orbita24</p>
            <h2>Weniger Umwege, mehr Orientierung</h2>
            <p>
              Wir setzen auf klare Informationen und einfache Strukturen, damit
              Sie sich schneller orientieren und
              <a href="/optionen/">Optionen</a> finden.
            </p>
          </div>

          <div class="trust-grid">
            <article class="card trust-card">
              <div class="icon" aria-hidden="true">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="#ff5a1f"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <g transform="translate(3 3) scale(0.75)">
                    <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                    <path d="m9 11 3 3L22 4" />
                  </g>
                </svg>
              </div>
              <h3>Klare Informationen</h3>
              <p>
                Inhalte werden so aufbereitet, dass Sie sie schnell erfassen und
                leicht verstehen k&ouml;nnen.
              </p>
            </article>

            <article class="card trust-card">
              <div class="icon" aria-hidden="true">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="#ff5a1f"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <g transform="translate(3 3) scale(0.75)">
                    <rect width="7" height="7" x="3" y="3" rx="1" />
                    <rect width="7" height="7" x="14" y="3" rx="1" />
                    <rect width="7" height="7" x="14" y="14" rx="1" />
                    <rect width="7" height="7" x="3" y="14" rx="1" />
                  </g>
                </svg>
              </div>
              <h3>Einfacher &Uuml;berblick</h3>
              <p>
                Wichtige Punkte stehen im Vordergrund, damit Entscheidungen
                nicht unn&ouml;tig kompliziert werden.
              </p>
            </article>

            <article class="card trust-card">
              <div class="icon" aria-hidden="true">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="#ff5a1f"
                  stroke-width="1.5"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <g transform="translate(3 3) scale(0.75)">
                    <circle cx="12" cy="12" r="10" />
                    <path d="m12 16 4-4-4-4" />
                    <path d="M8 12h8" />
                  </g>
                </svg>
              </div>
              <h3>Direkt zum n&auml;chsten Schritt</h3>
              <p>
                Sie finden schneller den passenden Weg und kommen ohne Umwege
                weiter.
              </p>
            </article>
          </div>
        </div>
      </section>

      <section class="section cta-section">
        <div class="container cta-box">
          <div class="cta-copy">
            <p class="eyebrow">Starten Sie jetzt</p>
            <h2>Sie m&ouml;chten einfach und schnell weiterkommen?</h2>
            <p>
              Wir zeigen Ihnen passende Optionen, damit Sie den n&auml;chsten
              Schritt einfach und schnell finden.
            </p>
          </div>

          <div class="cta-side">
            <a
              href="/optionen/"
              class="btn btn-primary cta-all-options"
              data-location="footer"
              >Alle Optionen ansehen</a
            >
          </div>
        </div>
      </section>
    </main>
    <?php include $orbita24Root . '/includes/footer.php'; ?>
    <?php include $orbita24Root . '/includes/scripts.php'; ?>
  </body>
</html>
