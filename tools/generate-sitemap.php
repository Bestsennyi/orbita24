<?php

$root = dirname(__DIR__);
$structure = require $root . '/data/site-structure.php';
$baseUrl = 'https://orbita24.de';
$urls = [];
$errors = [];

foreach ($structure as $page) {
    $url = $page['url'] ?? '';

    if (isset($urls[$url])) {
        $errors[] = "Duplicate URL in site-structure: {$url}";
        continue;
    }

    if (preg_match('#(index\.php|index\.html|optionen\.html)#', $url)) {
        $errors[] = "Forbidden URL in site-structure: {$url}";
    }

    $urls[$url] = $page;
}

if (count($urls) !== 49) {
    $errors[] = 'Expected 49 URLs, found ' . count($urls);
}

if ($errors) {
    fwrite(STDERR, "FAIL\n- " . implode("\n- ", $errors) . "\n");
    exit(1);
}

$xml = [];
$xml[] = '<?xml version="1.0" encoding="UTF-8"?>';
$xml[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

foreach ($urls as $page) {
    $xml[] = '  <url>';
    $xml[] = '    <loc>' . htmlspecialchars($baseUrl . $page['url'], ENT_XML1, 'UTF-8') . '</loc>';
    $xml[] = '    <lastmod>' . htmlspecialchars($page['lastmod'], ENT_XML1, 'UTF-8') . '</lastmod>';
    $xml[] = '    <priority>' . htmlspecialchars($page['priority'], ENT_XML1, 'UTF-8') . '</priority>';
    $xml[] = '  </url>';
}

$xml[] = '</urlset>';

file_put_contents($root . '/sitemap.xml', implode("\n", $xml) . "\n");
echo 'PASS sitemap.xml generated with ' . count($urls) . " URLs\n";
