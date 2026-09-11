<?php
/** Small render helpers used by every template. */
declare(strict_types=1);

/** Escape for HTML output. */
function e(?string $v): string
{
    return htmlspecialchars((string) $v, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Build an internal URL. Absolute, mail, tel and fragment-only links pass
 * through untouched so link lists can mix the two.
 */
function url(string $path = ''): string
{
    if ($path !== '' && ($path[0] === '#' || preg_match('#^(https?:|mailto:|tel:|//)#', $path))) {
        return $path;
    }
    return BASE . '/' . ltrim($path, '/');
}

/** Asset URL with an mtime cache-buster, so assets can be cached forever. */
function asset(string $path): string
{
    $path = ltrim($path, '/');
    $file = ROOT . '/' . $path;

    return BASE . '/' . $path . '?v=' . (is_file($file) ? filemtime($file) : 0);
}

/** `aria-current` marker for the active nav item. */
function active(bool $isCurrent): string
{
    return $isCurrent ? ' aria-current="page"' : '';
}

/** Photography URL at a given width (images are served by Unsplash's CDN). */
function photo(string $id, int $w = 1200, int $q = 72): string
{
    return "https://images.unsplash.com/photo-$id?auto=format&fit=crop&w=$w&q=$q";
}

/** Responsive srcset for a photo. */
function photo_srcset(string $id, array $widths = [480, 800, 1200, 1800]): string
{
    return implode(', ', array_map(fn (int $w) => photo($id, $w) . " {$w}w", $widths));
}

/** A complete lazy <img> for a photo. */
function photo_img(string $id, string $alt, string $sizes = '100vw', array $attrs = []): string
{
    $attrs += ['loading' => 'lazy', 'decoding' => 'async'];
    $extra = '';
    foreach ($attrs as $k => $v) {
        $extra .= ' ' . $k . '="' . e((string) $v) . '"';
    }

    return '<img src="' . e(photo($id, 1200)) . '" srcset="' . e(photo_srcset($id)) . '" sizes="' . e($sizes) . '" alt="' . e($alt) . '"' . $extra . '>';
}

/** WhatsApp deep link with an optional pre-filled message. */
function wa_link(string $text = ''): string
{
    return 'https://wa.me/' . WHATSAPP . ($text !== '' ? '?text=' . rawurlencode($text) : '');
}

/** Look up a project by slug. */
function project(string $slug): ?array
{
    foreach (PROJECTS as $p) {
        if ($p['slug'] === $slug) {
            return $p;
        }
    }
    return null;
}

function project_url(array $p): string
{
    return url('project?p=' . rawurlencode($p['slug']));
}

/** Rupees with Indian digit grouping: ₹12,34,567. */
function inr(float $amount): string
{
    $n    = (string) (int) round($amount);
    $last = substr($n, -3);
    $rest = substr($n, 0, -3);

    return '₹' . ($rest !== '' ? preg_replace('/\B(?=(\d{2})+$)/', ',', $rest) . ',' : '') . $last;
}

/** Monthly No Cost EMI on a price; defaults to the longest tenure (the lowest instalment). */
function no_cost_emi(int $price, int $months = NO_COST_EMI_MAX_MONTHS): float
{
    return $price * NO_COST_EMI_SHARE / 100 / $months;
}

/** Render a partial from includes/partials/. */
function part(string $name, array $data = []): void
{
    extract($data, EXTR_SKIP);
    require ROOT . '/includes/partials/' . $name . '.php';
}

/** Years since FOUNDED, for copy like "13 years". */
function years_active(): int
{
    return max(1, (int) date('Y') - FOUNDED);
}
