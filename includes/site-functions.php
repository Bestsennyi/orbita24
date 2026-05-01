<?php

const ORBITA24_BASE_URL = 'https://orbita24.de';

$orbita24CurrentPage = null;

function orbita24_site_structure(): array
{
    static $structure = null;

    if ($structure === null) {
        $structure = require dirname(__DIR__) . '/data/site-structure.php';
    }

    return $structure;
}

function orbita24_set_current_page(string $url): void
{
    global $orbita24CurrentPage;
    $orbita24CurrentPage = orbita24_normalize_public_url($url);
}

function orbita24_current_public_url(): string
{
    global $orbita24CurrentPage;

    if ($orbita24CurrentPage !== null) {
        return $orbita24CurrentPage;
    }

    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    return orbita24_normalize_public_url($path);
}

function orbita24_normalize_public_url(string $url): string
{
    $path = parse_url($url, PHP_URL_PATH) ?: '/';
    $path = '/' . ltrim($path, '/');
    $path = preg_replace('#/index\.(php|html)$#', '/', $path);
    $path = preg_replace('#/+#', '/', $path);

    if ($path !== '/' && !preg_match('#\.[a-z0-9]+$#i', $path)) {
        $path = rtrim($path, '/') . '/';
    }

    return $path;
}

function orbita24_find_page(?string $url = null): ?array
{
    $needle = orbita24_normalize_public_url($url ?? orbita24_current_public_url());

    foreach (orbita24_site_structure() as $page) {
        if ($page['url'] === $needle) {
            return $page;
        }
    }

    return null;
}

function orbita24_current_page(): array
{
    $page = orbita24_find_page();

    if ($page !== null) {
        return $page;
    }

    return [
        'url' => orbita24_current_public_url(),
        'title' => 'Orbita24',
        'meta_description' => 'Informationen und einfache Loesungen rund um verschiedene Dienstleistungen und Angebote.',
        'type' => 'legal',
        'parent' => null,
        'category' => null,
        'label' => 'Orbita24',
        'lastmod' => '2026-05-01',
        'priority' => '0.5',
    ];
}

function orbita24_canonical(?string $url = null): string
{
    return ORBITA24_BASE_URL . orbita24_normalize_public_url($url ?? orbita24_current_public_url());
}

function orbita24_escape(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function orbita24_nav_class(string $target, string $baseClass = ''): string
{
    $current = orbita24_current_public_url();
    $classes = trim($baseClass);
    $active = false;

    if ($target === '/') {
        $active = $current === '/';
    } elseif ($target === '/optionen/') {
        $active = $current === '/optionen/' || strpos($current, '/optionen/') === 0;
    } else {
        $active = $current === $target;
    }

    if ($active) {
        $classes = trim($classes . ' active');
        if ($target === '/optionen/') {
            $classes = trim($classes . ' is-optionen-active');
        }
    }

    return $classes;
}

function orbita24_is_options_section(): bool
{
    $current = orbita24_current_public_url();
    return $current === '/optionen/' || strpos($current, '/optionen/') === 0;
}

function orbita24_category_pages(?string $category = null): array
{
    $category = $category ?? (orbita24_current_page()['category'] ?? null);

    return array_values(array_filter(
        orbita24_site_structure(),
        static fn (array $page): bool => $page['type'] === 'child' && $page['category'] === $category
    ));
}

function orbita24_child_pages(string $category): array
{
    return orbita24_category_pages($category);
}

function orbita24_parent_chain(array $page): array
{
    $chain = [
        ['url' => '/', 'label' => 'Startseite'],
    ];

    if (strpos($page['url'], '/optionen/') !== 0) {
        return $chain;
    }

    $chain[] = ['url' => '/optionen/', 'label' => 'Optionen'];

    if ($page['type'] === 'category') {
        $chain[] = ['url' => $page['url'], 'label' => $page['label']];
        return $chain;
    }

    if ($page['type'] === 'child' && $page['parent']) {
        $parent = orbita24_find_page($page['parent']);
        if ($parent) {
            $chain[] = ['url' => $parent['url'], 'label' => $parent['label']];
        }
        $chain[] = ['url' => $page['url'], 'label' => $page['label']];
    }

    return $chain;
}

function orbita24_render_breadcrumbs(): void
{
    $page = orbita24_current_page();
    if (strpos($page['url'], '/optionen/') !== 0) {
        return;
    }

    $items = orbita24_parent_chain($page);
    $lastIndex = count($items) - 1;

    echo '<nav class="structure-breadcrumb" aria-label="Breadcrumb">' . PHP_EOL;
    foreach ($items as $index => $item) {
        if ($index > 0) {
            echo '              <span class="structure-breadcrumb-separator" aria-hidden="true">/</span>' . PHP_EOL;
        }

        if ($index === $lastIndex) {
            echo '              <span class="structure-breadcrumb-current" aria-current="page">' . orbita24_escape($item['label']) . '</span>' . PHP_EOL;
        } else {
            echo '              <a href="' . orbita24_escape($item['url']) . '">' . orbita24_escape($item['label']) . '</a>' . PHP_EOL;
        }
    }
    echo '            </nav>' . PHP_EOL;
}

function orbita24_render_related_topics(): void
{
    $page = orbita24_current_page();
    if ($page['type'] !== 'child' || !$page['category']) {
        return;
    }

    $topics = array_values(array_filter(
        orbita24_category_pages($page['category']),
        static fn (array $topic): bool => $topic['url'] !== $page['url']
    ));

    if (!$topics) {
        return;
    }

    $id = 'related-options-' . trim(str_replace('/', '-', trim($page['url'], '/')), '-');

    echo '        <section class="card related-options" aria-labelledby="' . orbita24_escape($id) . '">' . PHP_EOL;
    echo '          <h2 id="' . orbita24_escape($id) . '">Weitere Themen</h2>' . PHP_EOL;
    echo '          <div class="related-options-list">' . PHP_EOL;
    foreach ($topics as $topic) {
        echo '            <a href="' . orbita24_escape($topic['url']) . '">' . orbita24_escape($topic['label']) . '</a>' . PHP_EOL;
    }
    echo '          </div>' . PHP_EOL;
    echo '        </section>' . PHP_EOL;
}
