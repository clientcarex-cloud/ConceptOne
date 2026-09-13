<?php
require_once __DIR__ . '/includes/bootstrap.php';

$p = project((string) ($_GET['p'] ?? ''));
if ($p === null) {
    http_response_code(404);
    require __DIR__ . '/404.php';
    exit;
}

$facts    = $p['facts'] ?? [];
$bar      = $facts ? array_slice($facts, 0, 4, true) : ['Status' => STATUSES[$p['status']], 'Location' => $p['location'], 'Type' => $p['config'], 'Developer' => SITE_NAME];
$story    = $p['story'] ?? [$p['summary']];
$interest = 'Homes like ' . $p['name'];

// "More projects": the next three in listing order, wrapping around.
$index   = (int) array_search($p['slug'], array_column(PROJECTS, 'slug'), true);
$similar = array_map(fn (int $k) => PROJECTS[($index + $k) % count(PROJECTS)], [1, 2, 3]);

$page = [
    'nav'         => 'projects',
    'path'        => 'project?p=' . rawurlencode($p['slug']),
    'title'       => $p['name'] . ' — ' . $p['config'] . ' in ' . $p['location'] . ', ' . CITY . ' | ' . SITE_NAME,
    'description' => $p['summary'] . ' A ' . SITE_NAME . ' project in ' . $p['location'] . ', ' . CITY . '.',
    'image'       => $p['cover'],
];
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
    <p class="lead"><?= e($p['summary']) ?></p>
    <div class="facts-bar">
      <?php foreach ($bar as $label => $value): ?>
        <div class="fact"><span><?= e($label) ?></span><strong><?= e($value) ?></strong></div>
      <?php endforeach ?>
    </div>
  </div>
</section>

<div class="container">
  <div class="detail">
    <div class="detail-main">

      <section id="overview" data-reveal>
        <p class="eyebrow"><?= e($p['chapter'] ?? 'Overview') ?></p>
        <h2 class="h2"><?= $facts ? 'The story of <em>' . e($p['name']) . '.</em>' : 'Built <em>with purpose.</em>' ?></h2>
        <div class="prose">
          <?php foreach ($story as $para): ?><p><?= e($para) ?></p><?php endforeach ?>
          <?php if (!$facts): ?>
            <p><?= e($p['name']) ?> is one of the <?= figure('delivered') ?> projects <?= e(SITE_NAME) ?> has delivered across <?= CITY ?>, planned around our four principles: affordability, quality, transparency and easier ownership.</p>
          <?php endif ?>
        </div>
        <?php if ($facts): ?>
          <dl class="facts-list facts-card">
            <?php foreach ($facts as $label => $value): ?>
              <div><dt><?= e($label) ?></dt><dd><?= e($value) ?></dd></div>
            <?php endforeach ?>
            <?php if (!empty($p['units'])): ?>
              <div><dt>Sizes</dt><dd><?= e(implode(' · ', $p['units'])) ?></dd></div>
            <?php endif ?>
          </dl>
        <?php endif ?>
      </section>

      <section id="principles" data-reveal>
        <p class="eyebrow">Why <?= e(SITE_SHORT) ?></p>
        <h2 class="h2">Built on <em>four principles.</em></h2>
        <ul class="principles">
          <?php foreach (PRINCIPLES as [$ic, $title, $text]): ?>
            <li><?= icon($ic) ?><h3><?= e($title) ?></h3><p><?= e($text) ?></p></li>
          <?php endforeach ?>
        </ul>
      </section>

      <section id="location" data-reveal>
        <p class="eyebrow">Location</p>
        <h2 class="h2"><?= e($p['location']) ?>, <em><?= CITY ?>.</em></h2>
        <div class="map">
          <iframe title="Map of <?= e($p['location']) ?>, <?= CITY ?>" src="https://maps.google.com/maps?q=<?= rawurlencode($p['location'] . ', ' . CITY) ?>&amp;z=14&amp;output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <p class="note">Photographs are representative and may not depict the actual project.</p>
      </section>
    </div>

    <aside class="aside" aria-label="Enquire with <?= e(SITE_NAME) ?>">
      <div class="enquire-card on-dark">
        <div class="orb" aria-hidden="true"></div>
        <p class="eyebrow">Looking for a home like this?</p>
        <h3>Talk to our team</h3>
        <p class="enquire-intro">We have <?= STATS['ongoing']['n'] ?> projects under development across <?= CITY ?>. Share your details and we'll call you back.</p>
        <a class="emi-offer" href="<?= e(url('projects#ownership')) ?>"><?= icon('percent') ?><span><strong>No Cost EMI</strong> on <?= NO_COST_EMI_SHARE ?>% of the price, with <strong>zero interest</strong></span></a>
        <hr>
        <?php part('enquiry-form', ['compact' => true, 'project' => $interest, 'source' => 'project:' . $p['slug']]) ?>
        <div class="aside-actions">
          <a class="btn btn--wa btn--sm" href="<?= e(wa_link("Hi ConceptOne, I saw " . $p['name'] . ' (' . $p['location'] . ") and I'm looking for a similar home.")) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?>WhatsApp</a>
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
        <h2 class="h2">More of <em>our projects.</em></h2>
      </div>
      <a class="link-arrow" href="<?= e(url('projects')) ?>">All projects <?= icon('arrow-up-right') ?></a>
    </div>
    <div class="grid-projects">
      <?php foreach ($similar as $i => $s) part('project-card', ['p' => $s, 'i' => $i]) ?>
    </div>
  </div>
</section>

<?php require ROOT . '/includes/footer.php'; ?>
