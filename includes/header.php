<?php
/**
 * Document head, site header and mobile menu.
 * @var array $page  title, description, nav, path, [image], [noindex]
 */
$canonical = SITE_URL . '/' . ($page['path'] ?? '');
$ogImage   = isset($page['image']) ? photo($page['image'], 1200, 70) : SITE_URL . '/assets/img/Logo.png';
$current   = $page['nav'] ?? '';
$schema    = [
    '@context'      => 'https://schema.org',
    '@type'         => 'RealEstateAgent',
    'name'          => SITE_NAME,
    'alternateName' => 'Concept One Developers',
    'slogan'        => TAGLINE,
    'url'           => SITE_URL,
    'logo'          => SITE_URL . '/assets/img/Logo.png',
    'foundingDate'  => (string) FOUNDED,
    'founder'       => array_map(fn ($f) => ['@type' => 'Person', 'name' => $f['name'], 'jobTitle' => $f['role']], FOUNDERS),
    'employee'      => array_map(fn ($f) => ['@type' => 'Person', 'name' => $f['name'], 'jobTitle' => $f['role']], LEADERSHIP),
    'areaServed'    => CITY,
    'telephone'     => [PHONE, PHONE_ALT],
    'email'         => EMAIL,
    'address'       => [
        '@type'           => 'PostalAddress',
        'streetAddress'   => 'Plot No. 8-1-400/60 & 61, 2nd Floor, Westfield Center, above Dominos Pizza, Deluxe Colony, Janaki Nagar Colony, Toli Chowki',
        'addressLocality' => CITY,
        'addressRegion'   => 'Telangana',
        'postalCode'      => '500008',
        'addressCountry'  => 'IN',
    ],
    'openingHours'  => 'Mo-Su 12:00-20:00',
];
?>
<!DOCTYPE html>
<html lang="en-IN">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($page['title']) ?></title>
<meta name="description" content="<?= e($page['description']) ?>">
<?php if (!empty($page['noindex'])): ?>
<meta name="robots" content="noindex">
<?php endif ?>
<link rel="canonical" href="<?= e($canonical) ?>">
<meta name="theme-color" content="#121016">

<meta property="og:type" content="website">
<meta property="og:site_name" content="<?= e(SITE_NAME) ?>">
<meta property="og:title" content="<?= e($page['title']) ?>">
<meta property="og:description" content="<?= e($page['description']) ?>">
<meta property="og:url" content="<?= e($canonical) ?>">
<meta property="og:image" content="<?= e($ogImage) ?>">
<meta name="twitter:card" content="summary_large_image">

<link rel="icon" href="<?= asset('assets/img/favicon.png') ?>" type="image/png">
<link rel="apple-touch-icon" href="<?= asset('assets/img/apple-touch-icon.png') ?>">

<link rel="preconnect" href="https://images.unsplash.com">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Manrope:wght@400;500;600;700;800&display=swap">
<link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>">
<script>document.documentElement.classList.add("js");</script>
<script type="application/ld+json"><?= json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) ?></script>
</head>
<body>
<a class="skip-link" href="#content">Skip to content</a>

<header class="site-header">
  <div class="container">
    <a class="brand" href="<?= url() ?>" aria-label="<?= e(SITE_NAME) ?> — home">
      <img class="logo-light" src="<?= asset('assets/img/brand/logo-light.png') ?>" alt="" width="430" height="160">
      <img class="logo-color" src="<?= asset('assets/img/brand/logo-color.png') ?>" alt="" width="430" height="160">
    </a>

    <nav class="nav" aria-label="Main">
      <?php foreach (NAV as $key => [$label, $href, $children]): ?>
        <?php if ($children): ?>
          <div class="nav-item" data-dropdown>
            <a href="<?= e(url($href)) ?>"<?= active($key === $current) ?>><?= e($label) ?></a>
            <button class="nav-caret" type="button" aria-expanded="false" aria-controls="nav-<?= e($key) ?>"><span class="sr-only"><?= e($label) ?> sections</span><?= icon('chevron-down') ?></button>
            <div class="nav-menu" id="nav-<?= e($key) ?>">
              <ul>
                <?php foreach ($children as [$childLabel, $childHref]): ?>
                  <li><a href="<?= e(url($childHref)) ?>"><?= e($childLabel) ?></a></li>
                <?php endforeach ?>
              </ul>
            </div>
          </div>
        <?php else: ?>
          <a href="<?= e(url($href)) ?>"<?= active($key === $current) ?>><?= e($label) ?></a>
        <?php endif ?>
      <?php endforeach ?>
    </nav>

    <div class="header-actions">
      <a class="header-phone" href="tel:<?= PHONE_HREF ?>"><?= icon('phone') ?><?= e(PHONE) ?></a>
      <a class="btn btn--sm btn-cta" href="<?= e(enquire_url('Schedule a site visit')) ?>">Schedule a site visit</a>
      <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="mobile-menu" aria-label="Open menu">
        <?= icon('menu', 'icon icon-open') ?><?= icon('x', 'icon icon-close') ?>
      </button>
    </div>
  </div>
</header>

<div class="mobile-menu" id="mobile-menu">
  <nav aria-label="Mobile">
    <?php foreach (NAV as $key => [$label, $href, $children]): ?>
      <div class="m-item">
        <a class="m-link" href="<?= e(url($href)) ?>"<?= active($key === $current) ?>><?= e($label) ?></a>
        <?php if ($children): ?>
          <ul class="m-sub">
            <?php foreach ($children as [$childLabel, $childHref]): ?>
              <li><a href="<?= e(url($childHref)) ?>"><?= e($childLabel) ?></a></li>
            <?php endforeach ?>
          </ul>
        <?php endif ?>
      </div>
    <?php endforeach ?>
  </nav>
  <div class="mobile-menu-foot">
    <?php foreach (phones() as [$label, $href]): ?>
      <a href="tel:<?= e($href) ?>"><?= icon('phone') ?><?= e($label) ?></a>
    <?php endforeach ?>
    <a href="mailto:<?= EMAIL ?>"><?= icon('mail') ?><?= e(EMAIL) ?></a>
    <a class="btn btn--light" href="<?= e(enquire_url('Schedule a site visit')) ?>">Schedule a site visit <?= icon('arrow-right') ?></a>
  </div>
</div>

<main id="content">
