<?php
require_once __DIR__ . '/includes/bootstrap.php';

$page = [
    'nav'         => 'projects',
    'path'        => 'projects',
    'title'       => 'Our Projects — Delivered & Ongoing Homes in ' . CITY . ' | ' . SITE_NAME,
    'description' => 'Explore projects by ' . SITE_NAME . ': ' . figure('delivered') . ' delivered across ' . CITY . ', including Diamond Avenue and SmartCity Avenue, and ' . figure('ongoing') . ' under development. Flexible EMI and installment options.',
    'image'       => PHOTOS['projects_hero'],
];
$sections = ['delivered' => 'Delivered Projects', 'ongoing' => 'Ongoing Projects', 'ownership' => 'Payment Options'];
require ROOT . '/includes/header.php';
?>

<section class="page-hero page-hero--short on-dark">
  <?= photo_img(PHOTOS['projects_hero'], '', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']) ?>
  <div class="container">
    <ol class="crumbs">
      <li><a href="<?= url() ?>">Home</a></li>
      <li aria-current="page">Projects</li>
    </ol>
    <p class="eyebrow">Our Projects</p>
    <h1>Spaces built <em>with purpose.</em></h1>
    <p class="lead"><?= figure('delivered') ?> projects delivered and <?= figure('ongoing') ?> under development across <?= CITY ?>. Affordable homes. Thoughtful spaces. Easier ownership.</p>
  </div>
</section>

<?php part('subnav', ['sections' => $sections, 'label' => 'Projects sections']) ?>

<!-- ============ Delivered ============ -->
<section class="section" id="delivered">
  <div class="container">
    <div class="section-head">
      <div>
        <p class="eyebrow">Delivered Projects</p>
        <h2 class="h2">We deliver <em>what we promise.</em></h2>
      </div>
      <p class="lead">A selection of the <?= figure('delivered') ?> projects we have delivered, creating homes and living spaces across some of <?= CITY ?>'s prominent locations.</p>
    </div>
    <div class="grid-projects">
      <?php foreach (PROJECTS as $i => $p) part('project-card', ['p' => $p, 'i' => $i]) ?>
    </div>
    <p class="note">Photographs are representative and may not depict the actual projects.</p>
  </div>
</section>

<!-- ============ Ongoing ============ -->
<section class="section section--dark why on-dark" id="ongoing">
  <div class="orb" aria-hidden="true"></div>
  <div class="container">
    <div class="section-head">
      <div>
        <p class="eyebrow">Our Present Projects</p>
        <h2 class="h2">The journey <em>continues.</em></h2>
      </div>
      <p class="lead">We are not stopping at what we have already achieved. Today, <?= e(SITE_NAME) ?> is actively working on <?= STATS['ongoing']['n'] ?> new projects across <?= CITY ?>. Each new development is an opportunity to improve upon what we have built before.</p>
    </div>

    <div class="ongoing">
      <?php for ($n = 0; $n < STATS['ongoing']['n']; $n++): ?>
        <article class="ongoing-card" data-reveal style="--d:<?= $n * 0.08 ?>s">
          <div class="ongoing-media">
            <?= photo_img(ONGOING_PHOTOS[$n % count(ONGOING_PHOTOS)], '', '(max-width: 520px) 100vw, (max-width: 1000px) 50vw, 320px') ?>
            <span class="badge badge--ongoing"><?= e(STATUSES['ongoing']) ?></span>
          </div>
          <div class="ongoing-body">
            <small>New project <?= sprintf('%02d', $n + 1) ?></small>
            <h3>Details launching soon</h3>
            <p><?= icon('map-pin') ?><?= CITY ?></p>
          </div>
        </article>
      <?php endfor ?>
    </div>

    <div class="ongoing-foot" data-reveal>
      <ul class="ongoing-lines">
        <li>New locations. New communities. Same vision.</li>
        <li>Affordable homes. Thoughtful spaces. <em>Easier ownership.</em></li>
      </ul>
      <div class="btn-row">
        <a class="btn btn--light" href="<?= e(enquire_url('Ongoing projects')) ?>">Register your interest <?= icon('arrow-right') ?></a>
        <a class="btn btn--wa" href="<?= e(wa_link("Hi ConceptOne, I'd like to know about your ongoing projects.")) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?>WhatsApp us</a>
      </div>
    </div>
  </div>
</section>

<!-- ============ Easier ownership ============ -->
<section class="section" id="ownership">
  <div class="container">
    <div class="section-head">
      <div>
        <p class="eyebrow">Easier Ownership</p>
        <h2 class="h2">Owning a home, <em>made easier.</em></h2>
      </div>
      <p class="lead">Making a home affordable is only one part of the solution. <?= e(SITE_SHORT) ?> pairs quality homes with payment solutions designed to make the journey towards owning one simpler.</p>
    </div>
    <?php part('offerings') ?>

    <div class="emi">
      <div class="emi-copy" data-reveal>
        <p class="eyebrow">No Cost EMI</p>
        <h2 class="h2"><?= NO_COST_EMI_SHARE ?>% of the price, <em>zero interest.</em></h2>
        <p class="lead">We offer No Cost EMI on <?= NO_COST_EMI_SHARE ?>% of your home's price, directly from <?= e(SITE_SHORT) ?>. Spread that <?= NO_COST_EMI_SHARE ?>% across easy monthly instalments and pay no interest on it.</p>
        <ul class="checks">
          <li><span class="tick"><?= icon('check') ?></span>No interest and no bank involved</li>
          <li><span class="tick"><?= icon('check') ?></span>Tenures from <?= NO_COST_EMI_MIN_MONTHS ?> to <?= NO_COST_EMI_MAX_MONTHS ?> months</li>
          <li><span class="tick"><?= icon('check') ?></span>The balance <?= 100 - NO_COST_EMI_SHARE ?>% follows the project's payment schedule</li>
        </ul>
        <a class="btn btn--dark" href="<?= e(enquire_url('No Cost EMI & installment plans')) ?>">Ask about payment plans <?= icon('arrow-right') ?></a>
      </div>
      <div data-reveal style="--d:.15s">
        <?php part('emi', ['price' => 6000000]) ?>
      </div>
    </div>
    <p class="note"><?= e(PAYMENT_NOTE) ?></p>
  </div>
</section>

<?php part('cta') ?>

<?php require ROOT . '/includes/footer.php'; ?>
