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

/** A founder's portrait from assets/img/team, WebP first. */
function founder_img(array $f, string $class = ''): string
{
    $stem = 'assets/img/team/' . $f['photo'];

    return '<picture><source type="image/webp" srcset="' . asset($stem . '.webp') . '">'
        . '<img' . ($class !== '' ? ' class="' . e($class) . '"' : '') . ' src="' . asset($stem . '.jpg') . '" alt="Portrait of ' . e($f['name']) . '" width="640" height="800" loading="lazy" decoding="async"></picture>';
}

/** Both sales lines as [display, tel href] pairs, primary first. */
function phones(): array
{
    return [[PHONE, PHONE_HREF], [PHONE_ALT, PHONE_ALT_HREF]];
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

/** Projects for a list of slugs, in that order. Unknown slugs are skipped. */
function projects_by_slug(array $slugs): array
{
    return array_values(array_filter(array_map('project', $slugs)));
}

function project_url(array $p): string
{
    return url('project?p=' . rawurlencode($p['slug']));
}

/** Contact-page URL with the enquiry form's "interested in" pre-selected. */
function enquire_url(string $interest = ''): string
{
    return url('contact' . ($interest !== '' ? '?interest=' . rawurlencode($interest) : '')) . '#enquire';
}

/** A STATS figure as display text, e.g. "6+". */
function figure(string $key): string
{
    return STATS[$key]['n'] . STATS[$key]['suffix'];
}

/** Render a partial from includes/partials/. */
function part(string $name, array $data = []): void
{
    extract($data, EXTR_SKIP);
    require ROOT . '/includes/partials/' . $name . '.php';
}
