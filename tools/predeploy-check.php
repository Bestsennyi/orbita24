<?php

$root = dirname(__DIR__);
$errors = [];

function add_error(array &$errors, string $message): void
{
    $errors[] = $message;
}

function read_file_checked(string $path, array &$errors): string
{
    if (!is_file($path)) {
        add_error($errors, 'Missing file: ' . $path);
        return '';
    }

    $content = file_get_contents($path);
    if (substr($content, 0, 3) === "\xEF\xBB\xBF") {
        add_error($errors, 'BOM found: ' . $path);
    }
    if (preg_match('/\x{FFFD}|\x{00C2}|\x{00C3}|\x{0432}\x{0453}|\x{0432}\x{043D}/u', $content)) {
        add_error($errors, 'Mojibake marker found: ' . $path);
    }

    return $content;
}

function public_path_for_url(string $root, string $url): string
{
    if ($url === '/') {
        return $root . '/index.php';
    }
    if (substr($url, -1) === '/') {
        return $root . $url . 'index.php';
    }
    return $root . $url;
}

function normalize_link_path(string $path): string
{
    $path = parse_url($path, PHP_URL_PATH) ?: '/';
    $path = '/' . ltrim($path, '/');
    $path = preg_replace('#/index\.(php|html)$#', '/', $path);
    $path = preg_replace('#/+#', '/', $path);
    if ($path !== '/' && !preg_match('#\.[a-z0-9]+$#i', $path)) {
        $path = rtrim($path, '/') . '/';
    }
    return $path;
}

$structure = require $root . '/data/site-structure.php';
$urls = array_column($structure, 'url');

if (count($structure) !== 49) {
    add_error($errors, 'Public URL count must be exactly 49, found ' . count($structure));
}
if (count(array_unique($urls)) !== count($urls)) {
    add_error($errors, 'Duplicate URL in site-structure');
}
foreach ($urls as $url) {
    if (preg_match('#(index\.php|index\.html|optionen\.html)#', $url)) {
        add_error($errors, 'Forbidden public URL in site-structure: ' . $url);
    }
}

$publicFiles = [];
foreach ($structure as $page) {
    $file = public_path_for_url($root, $page['url']);
    $publicFiles[$file] = $page['url'];
    if (!is_file($file)) {
        add_error($errors, 'Missing public file for ' . $page['url'] . ': ' . $file);
    }
}

$publicFiles[$root . '/js/script.js'] = 'script';
$publicFiles[$root . '/includes/head.php'] = 'head include';
$publicFiles[$root . '/includes/cookiebot-head.php'] = 'cookiebot include';
$publicFiles[$root . '/includes/gtm-loader.php'] = 'gtm include';
$publicFiles[$root . '/includes/header.php'] = 'header include';
$publicFiles[$root . '/includes/footer.php'] = 'footer include';
$publicFiles[$root . '/includes/scripts.php'] = 'scripts include';
$publicFiles[$root . '/data/site-structure.php'] = 'site structure';
$publicFiles[$root . '/sitemap.xml'] = 'sitemap';
$publicFiles[$root . '/robots.txt'] = 'robots';

$contents = [];
foreach ($publicFiles as $file => $label) {
    $contents[$file] = read_file_checked($file, $errors);
}

foreach ($structure as $page) {
    $expected = 'https://orbita24.de' . $page['url'];
    $file = public_path_for_url($root, $page['url']);
    $content = $contents[$file] ?? '';

    if (substr($page['url'], -1) === '/' || $page['url'] === '/') {
        if (strpos($content, "includes/head.php") === false) {
            add_error($errors, 'PHP page does not include central head: ' . $page['url']);
        }
    } elseif (preg_match('/<link\s+rel="canonical"\s+href="([^"]+)"/', $content, $match)) {
        if ($match[1] !== $expected) {
            add_error($errors, 'Canonical mismatch on ' . $page['url'] . ': ' . $match[1]);
        }
        if (preg_match('#(index\.php|index\.html)#', $match[1])) {
            add_error($errors, 'Forbidden canonical on ' . $page['url'] . ': ' . $match[1]);
        }
    } else {
        add_error($errors, 'Missing canonical on ' . $page['url']);
    }

    if ($page['url'] !== '/' && ($page['url'] !== '/about.html' && strpos($content, 'https://orbita24.de/"') !== false && strpos($content, '<link rel="canonical" href="https://orbita24.de/"') !== false)) {
        add_error($errors, 'Inner page canonical points to home: ' . $page['url']);
    }
}

$sitemap = $contents[$root . '/sitemap.xml'] ?? '';
preg_match_all('#<loc>(https://orbita24\.de[^<]+)</loc>#', $sitemap, $locMatches);
$sitemapUrls = array_map(static fn ($loc): string => substr($loc, strlen('https://orbita24.de')), $locMatches[1]);
if (count($sitemapUrls) !== 49) {
    add_error($errors, 'Sitemap must contain 49 URLs, found ' . count($sitemapUrls));
}
if (count(array_unique($sitemapUrls)) !== count($sitemapUrls)) {
    add_error($errors, 'Duplicate URL in sitemap');
}
foreach ($urls as $url) {
    if (!in_array($url, $sitemapUrls, true)) {
        add_error($errors, 'URL missing from sitemap: ' . $url);
    }
}
foreach ($sitemapUrls as $url) {
    if (!in_array($url, $urls, true)) {
        add_error($errors, 'Stale URL in sitemap: ' . $url);
    }
    if (preg_match('#(index\.php|index\.html|optionen\.html)#', $url)) {
        add_error($errors, 'Forbidden URL in sitemap: ' . $url);
    }
}

$robots = $contents[$root . '/robots.txt'] ?? '';
foreach (['User-agent: *', 'Allow: /', 'Sitemap: https://orbita24.de/sitemap.xml'] as $needle) {
    if (strpos($robots, $needle) === false) {
        add_error($errors, 'robots.txt missing: ' . $needle);
    }
}
if (preg_match('#Disallow:\s*/(optionen|css|js)/#i', $robots, $match)) {
    add_error($errors, 'robots.txt blocks public asset/option path: ' . $match[0]);
}

foreach (['favicon.ico', 'favicon-16x16.png', 'favicon-32x32.png', 'favicon-48x48.png'] as $favicon) {
    if (!is_file($root . '/' . $favicon)) {
        add_error($errors, 'Missing favicon file: ' . $favicon);
    }
    if (strpos($contents[$root . '/includes/head.php'] ?? '', '/' . $favicon) === false) {
        add_error($errors, 'head.php does not reference favicon: ' . $favicon);
    }
}

$headBundle = ($contents[$root . '/includes/head.php'] ?? '') . ($contents[$root . '/includes/cookiebot-head.php'] ?? '') . ($contents[$root . '/includes/gtm-loader.php'] ?? '');
if (strpos($headBundle, 'GTM-5HL9LFK4') === false) {
    add_error($errors, 'GTM-5HL9LFK4 not found in includes');
}
if (strpos($headBundle, 'Cookiebot') === false || strpos($headBundle, '2442c9f2-b102-489d-b183-906d466fc319') === false) {
    add_error($errors, 'Cookiebot ID not found in includes');
}
foreach (['analytics_storage: "denied"', 'ad_storage: "denied"'] as $needle) {
    if (strpos($headBundle, $needle) === false) {
        add_error($errors, 'Consent default denied missing: ' . $needle);
    }
}
if (preg_match('#gtag/js\?id=G-#', $headBundle)) {
    add_error($errors, 'Direct GA4 loader found instead of GTM');
}
if (substr_count($headBundle, 'googletagmanager.com/gtm.js') !== 1) {
    add_error($errors, 'GTM loader duplicate/missing in central includes');
}

$knownUrls = array_flip($urls);
$missingLinks = [];
$allPublicSource = '';
$indexableSource = '';
foreach ($publicFiles as $file => $label) {
    $content = $contents[$file] ?? '';
    $allPublicSource .= "\n" . $content;
    preg_match_all('/\s(?:href|src)=["\']([^"\']+)["\']/', $content, $matches);
    foreach ($matches[1] as $link) {
        if ($link === '' || $link[0] === '#' || preg_match('#^(https?:)?//#', $link) || preg_match('#^(mailto|tel):#', $link)) {
            continue;
        }
        if (strpos($link, '../') !== false) {
            add_error($errors, 'Relative parent link found in ' . $label . ': ' . $link);
        }
        if (preg_match('#(optionen\.html|/index\.html|index\.php)#', $link)) {
            add_error($errors, 'Forbidden public link in ' . $label . ': ' . $link);
        }
        $path = parse_url($link, PHP_URL_PATH) ?: '';
        if ($path === '' || $path[0] !== '/') {
            continue;
        }
        $fullPath = $root . $path;
        $normalized = normalize_link_path($path);
        if (isset($knownUrls[$normalized])) {
            continue;
        }
        if (is_file($fullPath)) {
            continue;
        }
        if (is_dir($fullPath) && is_file(rtrim($fullPath, '/\\') . '/index.php')) {
            continue;
        }
        $missingLinks[] = $label . ' -> ' . $link;
    }
}
foreach ($structure as $page) {
    $indexableSource .= "\n" . ($contents[public_path_for_url($root, $page['url'])] ?? '');
}
$indexableSource .= "\n" . ($contents[$root . '/includes/head.php'] ?? '');
$indexableSource .= "\n" . ($contents[$root . '/includes/header.php'] ?? '');
$indexableSource .= "\n" . ($contents[$root . '/includes/footer.php'] ?? '');
foreach (array_unique($missingLinks) as $missing) {
    add_error($errors, 'Missing internal href/src: ' . $missing);
}

$script = $contents[$root . '/js/script.js'] ?? '';
foreach (['view_options_click', 'affiliate_click', 'contact_form_submit', 'button_text', 'button_location', 'page_path', 'offer_name', 'offer_category', 'offer_position', 'offer_url'] as $needle) {
    if (strpos($script, $needle) === false) {
        add_error($errors, 'Analytics event/payload missing in script.js: ' . $needle);
    }
}

if (preg_match('/<meta[^>]+noindex/i', $indexableSource)) {
    add_error($errors, 'noindex found');
}
if (preg_match('/<a[^>]+rel=["\'][^"\']*nofollow/i', $indexableSource)) {
    add_error($errors, 'nofollow found on internal link candidate');
}

if ($errors) {
    echo "FAIL\n";
    foreach ($errors as $error) {
        echo '- ' . $error . "\n";
    }
    exit(1);
}

echo "PASS\n";
echo "- Public URLs: 49\n";
echo "- Sitemap URLs: 49\n";
echo "- Missing internal href/src: 0\n";
echo "- Canonicals clean\n";
echo "- GTM/Cookiebot checks passed\n";
