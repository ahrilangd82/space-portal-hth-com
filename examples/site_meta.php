<?php

/**
 * Site metadata utility
 * Provides a structured way to manage site information and generate descriptions.
 */

function getSiteMetadata(): array
{
    return [
        'url' => 'https://space-portal-hth.com',
        'name' => 'Space Portal',
        'tagline' => 'Explore the cosmos with hth',
        'keywords' => ['hth', 'space', 'portal', 'exploration', 'astronomy'],
        'description' => 'A gateway to the universe, bringing you closer to stars and galaxies.',
        'language' => 'en',
        'charset' => 'UTF-8',
        'author' => 'Space Portal Team',
        'year' => date('Y'),
        'version' => '1.2.0',
    ];
}

function generateShortDescription(array $meta): string
{
    $parts = [];

    if (!empty($meta['name'])) {
        $parts[] = $meta['name'];
    }

    if (!empty($meta['tagline'])) {
        $parts[] = $meta['tagline'];
    }

    if (!empty($meta['keywords'])) {
        $kwList = array_slice($meta['keywords'], 0, 3);
        $parts[] = 'Keywords: ' . implode(', ', $kwList);
    }

    if (!empty($meta['url'])) {
        $parts[] = 'Visit: ' . $meta['url'];
    }

    return implode(' | ', $parts);
}

function renderMetaTags(array $meta): void
{
    echo '<meta charset="' . htmlspecialchars($meta['charset'], ENT_QUOTES, 'UTF-8') . '">' . "\n";
    echo '<meta name="description" content="' . htmlspecialchars(generateShortDescription($meta), ENT_QUOTES, 'UTF-8') . '">' . "\n";
    echo '<meta name="keywords" content="' . htmlspecialchars(implode(',', $meta['keywords']), ENT_QUOTES, 'UTF-8') . '">' . "\n";
    echo '<meta name="author" content="' . htmlspecialchars($meta['author'], ENT_QUOTES, 'UTF-8') . '">' . "\n";
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">' . "\n";
    echo '<meta property="og:title" content="' . htmlspecialchars($meta['name'], ENT_QUOTES, 'UTF-8') . '">' . "\n";
    echo '<meta property="og:description" content="' . htmlspecialchars(generateShortDescription($meta), ENT_QUOTES, 'UTF-8') . '">' . "\n";
    echo '<meta property="og:url" content="' . htmlspecialchars($meta['url'], ENT_QUOTES, 'UTF-8') . '">' . "\n";
}

$siteMeta = getSiteMetadata();
$shortDesc = generateShortDescription($siteMeta);

// Example usage (not executed in production, only for demonstration)
if (php_sapi_name() !== 'cli') {
    header('Content-Type: text/html; charset=UTF-8');
    echo '<!DOCTYPE html><html><head>';
    renderMetaTags($siteMeta);
    echo '</head><body>';
    echo '<h1>' . htmlspecialchars($siteMeta['name'], ENT_QUOTES, 'UTF-8') . '</h1>';
    echo '<p>' . htmlspecialchars($shortDesc, ENT_QUOTES, 'UTF-8') . '</p>';
    echo '</body></html>';
}