<?php
$orbita24IsOptions = orbita24_is_options_section();
$orbita24CtaClass = 'btn btn-primary nav-cta cta-all-options' . ($orbita24IsOptions ? ' is-active-section is-in-options is-optionen-active' : '');
?>
<header class="site-header">
  <div class="container nav">
    <a href="/" class="logo" aria-label="Orbita24 Startseite">
      <img
        src="/images/logo-orbita24.svg"
        alt="Orbita24 Logo"
        class="logo-img"
        width="1991"
        height="390"
        decoding="async"
      />
    </a>

    <button
      class="nav-toggle"
      aria-label="Men&uuml; &ouml;ffnen"
      aria-expanded="false"
      aria-controls="main-navigation"
    >
      <span></span>
      <span></span>
      <span></span>
    </button>

    <nav class="nav-menu" id="main-navigation" aria-label="Hauptnavigation">
      <a href="/" class="<?= orbita24_escape(orbita24_nav_class('/')) ?>"<?= orbita24_current_public_url() === '/' ? ' aria-current="page"' : '' ?>>Startseite</a>
      <a href="/optionen/" class="<?= orbita24_escape(orbita24_nav_class('/optionen/', 'nav-mobile-options')) ?>"<?= $orbita24IsOptions ? ' aria-current="page"' : '' ?>>Optionen</a>
      <a href="/about.html" class="<?= orbita24_escape(orbita24_nav_class('/about.html')) ?>"<?= orbita24_current_public_url() === '/about.html' ? ' aria-current="page"' : '' ?>>&Uuml;ber uns</a>
      <a href="/kontakt.php" class="<?= orbita24_escape(orbita24_nav_class('/kontakt.php')) ?>"<?= orbita24_current_public_url() === '/kontakt.php' ? ' aria-current="page"' : '' ?>>Kontakt</a>
    </nav>

    <a
      href="/optionen/"
      class="<?= orbita24_escape($orbita24CtaClass) ?>"
      data-location="header"
      >Alle Optionen ansehen</a
    >
  </div>
</header>
