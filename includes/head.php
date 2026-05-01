<?php
$orbita24Page = orbita24_current_page();
$orbita24Canonical = orbita24_canonical($orbita24Page['url']);
?>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<?php include __DIR__ . '/cookiebot-head.php'; ?>
<?php include __DIR__ . '/gtm-loader.php'; ?>
<title><?= orbita24_escape($orbita24Page['title']) ?></title>
<meta name="description" content="<?= orbita24_escape($orbita24Page['meta_description']) ?>" />
<meta name="robots" content="index, follow" />
<meta name="theme-color" content="#111827" />
<meta property="og:type" content="website" />
<meta property="og:locale" content="de_DE" />
<meta property="og:site_name" content="Orbita24" />
<meta property="og:title" content="<?= orbita24_escape($orbita24Page['title']) ?>" />
<meta property="og:description" content="<?= orbita24_escape($orbita24Page['meta_description']) ?>" />
<meta property="og:url" content="<?= orbita24_escape($orbita24Canonical) ?>" />
<meta property="og:image" content="https://orbita24.de/images/hero-bg.webp" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="<?= orbita24_escape($orbita24Page['title']) ?>" />
<meta name="twitter:description" content="<?= orbita24_escape($orbita24Page['meta_description']) ?>" />
<meta name="twitter:image" content="https://orbita24.de/images/hero-bg.webp" />
<link rel="canonical" href="<?= orbita24_escape($orbita24Canonical) ?>" />
<link rel="icon" href="/favicon.ico" type="image/x-icon" />
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png" />
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png" />
<link rel="icon" type="image/png" sizes="48x48" href="/favicon-48x48.png" />
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
<link rel="manifest" href="/site.webmanifest" />
