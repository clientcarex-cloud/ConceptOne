<?php
require_once __DIR__ . '/includes/bootstrap.php';

$p = project((string) ($_GET['p'] ?? ''));
if ($p === null) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    exit;
}

$page = [
    'nav'         => 'projects',
    'path'        => 'project?p=' . rawurlencode($p['slug']),
    'title'       => $p['name'] . ' — ' . $p['config'] . ' in ' . $p['location'] . ', ' . CITY . ' | ' . SITE_NAME,
    'description' => $p['summary'] . ' Starting ' . $p['price'] . '. ' . $p['possession'] . '.',
    'image'       => $p['cover'],
    'lightbox'    => true,
];

$images      = array_slice(array_merge([$p['cover']], $p['gallery']), 0, 5);
$residential = $p['type'] !== 'Commercial';
$building    = $p['status'] === 'ongoing' && $p['milestones'];
$interest    = $p['name'] . ' — ' . $p['location'];

// Similar projects: same type first, then the rest.
$others = array_values(array_filter(PROJECTS, fn ($x) => $x['slug'] !== $p['slug']));
usort($others, fn ($a, $b) => ($b['type'] === $p['type']) <=> ($a['type'] === $p['type']));
$similar = array_slice($others, 0, 3);

$sections = ['overview' => 'Overview', 'gallery' => 'Gallery', 'plans' => 'Plans & pricing', 'amenities' => 'Amenities', 'location' => 'Location'];
if ($building) {
    $sections['progress'] = 'Progress';
}
if ($residential) {
    $sections['specifications'] = 'Specifications';
}
$sections['emi'] = 'No Cost EMI';

require ROOT . '/includes/header.php';
?>

<section class="page-hero page-hero--project on-dark">
  <?= photo_img($p['cover'], '', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']) ?>
  <div class="container">
    <ol class="crumbs">
      <li><a href="<?= url() ?>">Home</a></li>
      <li><a href="<?= e(url('projects')) ?>">Projects</a></li>
      <li aria-current="page"><?= e($p['name']) ?></li>
    </ol>
    <div class="project-status">
      <span class="badge badge--<?= e($p['status']) ?>"><?= e(STATUSES[$p['status']]) ?></span>
      <span class="project-loc"><?= icon('map-pin') ?><?= e($p['location'] . ', ' . CITY) ?></span>
    </div>
    <h1><?= e($p['name']) ?></h1>
    <p class="lead"><?= e($p['tagline']) ?></p>
    <div class="facts-bar">
      <div class="fact"><span>Configuration</span><strong><?= e($p['config']) ?></strong></div>
      <div class="fact"><span>Size</span><strong><?= e($p['size']) ?></strong></div>
      <div class="fact"><span>Starting price</span><strong><?= e($p['price']) ?></strong></div>
      <div class="fact"><span>Possession</span><strong><?= e($p['possession']) ?></strong></div>
    </div>
  </div>
</section>

<nav class="subnav" aria-label="Project sections">
  <div class="container">
    <ul>
      <?php foreach ($sections as $id => $label): ?>
        <li><a href="#<?= $id ?>"><?= e($label) ?></a></li>
      <?php endforeach ?>
    </ul>
  </div>
</nav>

<div class="container">
  <div class="detail">
    <div class="detail-main">

      <section id="overview" data-reveal>
        <p class="eyebrow">Overview</p>
        <h2 class="h2">Why you'll love <em>living here.</em></h2>
        <div class="prose">
          <?php foreach ($p['overview'] as $para): ?><p><?= e($para) ?></p><?php endforeach ?>
        </div>
        <ul class="highlights">
          <?php foreach ($p['highlights'] as $h): ?>
            <li><span class="tick"><?= icon('check') ?></span><?= e($h) ?></li>
          <?php endforeach ?>
        </ul>
        <div class="spec-row">
          <?php foreach ($p['specs'] as $label => $value): ?>
            <div><strong><?= e($value) ?></strong><span><?= e($label) ?></span></div>
          <?php endforeach ?>
        </div>
      </section>

      <section id="gallery" data-reveal>
        <p class="eyebrow">Gallery</p>
        <h2 class="h2">Inside <em>&amp; out.</em></h2>
        <div class="gallery">
          <?php foreach ($images as $n => $img): ?>
            <a href="<?= e(photo($img, 2000, 80)) ?>" data-lightbox>
              <?= photo_img($img, $p['name'] . ' — view ' . ($n + 1), $n === 0 ? '(max-width: 700px) 100vw, 45vw' : '(max-width: 700px) 50vw, 22vw') ?>
              <span class="gallery-zoom" aria-hidden="true"><?= icon('maximize') ?></span>
            </a>
          <?php endforeach ?>
        </div>
        <p class="note">Images are artistic impressions for representation only.</p>
      </section>

      <section id="plans" data-reveal>
        <p class="eyebrow">Plans &amp; pricing</p>
        <h2 class="h2">Choose <em>your space.</em></h2>
        <div class="table-wrap">
          <table class="plans">
            <thead><tr><th scope="col">Configuration</th><th scope="col">Size (SBA)</th><th scope="col">Starting price</th><th scope="col"><span class="sr-only">Action</span></th></tr></thead>
            <tbody>
              <?php foreach ($p['plans'] as [$conf, $size, $price]): ?>
                <tr>
                  <td><?= e($conf) ?></td>
                  <td><?= e($size) ?></td>
                  <td><?= e($price) ?></td>
                  <td><a class="link-arrow" href="<?= e(url('contact?interest=' . rawurlencode($interest))) ?>#enquire">Get floor plan <?= icon('arrow-up-right') ?></a></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
        <p class="note"><?= e(PRICE_NOTE) ?><?= $p['rera'] !== '' ? ' RERA No. ' . e($p['rera']) . '.' : '' ?></p>
      </section>

      <section id="amenities" data-reveal>
        <p class="eyebrow">Amenities</p>
        <h2 class="h2">Everything you need, <em>on site.</em></h2>
        <ul class="amenities">
          <?php foreach ($p['amenities'] as $a): ?>
            <li class="amenity"><?= icon($a) ?><?= e(AMENITY_SET[$a]) ?></li>
          <?php endforeach ?>
        </ul>
      </section>

      <section id="location" data-reveal>
        <p class="eyebrow">Location</p>
        <h2 class="h2">Well connected, <em>naturally.</em></h2>
        <ul class="nearby">
          <?php foreach ($p['nearby'] as [$ic, $place, $time]): ?>
            <li><span class="nearby-icon"><?= icon($ic) ?></span><?= e($place) ?><strong><?= e($time) ?></strong></li>
          <?php endforeach ?>
        </ul>
        <div class="map">
          <iframe title="Map of <?= e($p['location']) ?>, <?= CITY ?>" src="https://maps.google.com/maps?q=<?= rawurlencode($p['location'] . ', ' . CITY) ?>&amp;z=13&amp;output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </section>

      <?php if ($building): ?>
        <section id="progress" data-reveal>
          <p class="eyebrow">Construction progress</p>
          <h2 class="h2">On site, <em>on schedule.</em></h2>
          <div class="progress-head"><span>Overall completion</span><strong><?= (int) $p['progress'] ?>%</strong></div>
          <div class="progress-bar" role="progressbar" aria-valuenow="<?= (int) $p['progress'] ?>" aria-valuemin="0" aria-valuemax="100" aria-label="Construction progress"><span style="--w:<?= (int) $p['progress'] ?>%"></span></div>
          <ul class="milestones">
            <?php foreach ($p['milestones'] as $label => $state): ?>
              <li class="is-<?= e($state) ?>"><span class="ms-dot"><?= $state === 'done' ? icon('check') : '' ?></span><?= e($label) ?></li>
            <?php endforeach ?>
          </ul>
          <p class="note">Target possession <?= e($p['possession']) ?>. Buyers receive photo progress reports every month.</p>
        </section>
      <?php endif ?>

      <?php if ($residential): ?>
        <section id="specifications" data-reveal>
          <p class="eyebrow">Specifications</p>
          <h2 class="h2">Built <em>to last.</em></h2>
          <div class="accordion">
            <?php foreach (SPECIFICATIONS as $title => $text): ?>
              <details>
                <summary><?= e($title) ?><?= icon('plus') ?></summary>
                <p><?= e($text) ?></p>
              </details>
            <?php endforeach ?>
          </div>
        </section>
      <?php endif ?>

      <section id="emi" data-reveal>
        <p class="eyebrow">No Cost EMI</p>
        <h2 class="h2"><?= NO_COST_EMI_SHARE ?>% of the price, <em>zero interest.</em></h2>
        <?php part('emi', ['price' => $p['price_value']]) ?>
      </section>
    </div>

    <aside class="aside" aria-label="Enquire about <?= e($p['name']) ?>">
      <div class="enquire-card on-dark">
        <div class="orb" aria-hidden="true"></div>
        <div class="price">
          <small>Starting from</small>
          <strong><?= e($p['price']) ?></strong>
          <span><?= e($p['config']) ?> · <?= e($p['size']) ?></span>
        </div>
        <a class="emi-offer" href="#emi"><?= icon('percent') ?><span><strong>No Cost EMI</strong> on <?= NO_COST_EMI_SHARE ?>% of the price, from <strong><?= inr(no_cost_emi($p['price_value'])) ?>/month</strong></span></a>
        <hr>
        <h3>Schedule a site visit</h3>
        <?php part('enquiry-form', ['compact' => true, 'project' => $interest, 'source' => 'project:' . $p['slug']]) ?>
        <div class="aside-actions">
          <a class="btn btn--wa btn--sm" href="<?= e(wa_link("Hi, I'm interested in " . $p['name'] . ', ' . $p['location'] . '.')) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?>WhatsApp</a>
          <a class="btn btn--ghost btn--sm" href="tel:<?= PHONE_HREF ?>"><?= icon('phone') ?>Call</a>
        </div>
      </div>
    </aside>
  </div>
</div>

<section class="section section--sand">
  <div class="container">
    <div class="section-head">
      <div>
        <p class="eyebrow">Keep exploring</p>
        <h2 class="h2">You may also <em>like.</em></h2>
      </div>
      <a class="link-arrow" href="<?= e(url('projects')) ?>">All projects <?= icon('arrow-up-right') ?></a>
    </div>
    <div class="grid-projects">
      <?php foreach ($similar as $i => $s) part('project-card', ['p' => $s, 'i' => $i]) ?>
    </div>
  </div>
</section>

<?php require ROOT . '/includes/footer.php'; ?>
