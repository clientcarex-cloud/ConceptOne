<?php
require_once __DIR__ . '/includes/bootstrap.php';

$page = [
    'nav'         => 'about',
    'path'        => 'about',
    'title'       => 'About Us — Our Story, Values & Leadership | ' . SITE_NAME,
    'description' => 'Since ' . FOUNDED . ', ' . SITE_NAME . ' has built homes and workspaces across ' . CITY . ' on clear titles, honest pricing and on-schedule delivery. Meet the team behind the promise.',
    'image'       => PHOTOS['about_hero'],
];
require ROOT . '/includes/header.php';
?>

<section class="page-hero on-dark">
  <?= photo_img(PHOTOS['about_hero'], '', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']) ?>
  <div class="container">
    <ol class="crumbs">
      <li><a href="<?= url() ?>">Home</a></li>
      <li aria-current="page">About</li>
    </ol>
    <h1>Building <?= CITY ?>'s <em>next chapter.</em></h1>
    <p class="lead">A developer driven by one idea: build every home as if our own family were moving in.</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="story">
      <div class="story-media" data-reveal>
        <?= photo_img(PHOTOS['about_story'], 'A contemporary home by ' . SITE_NAME, '(max-width: 960px) 90vw, 45vw') ?>
        <p class="story-year"><small>Building since</small><?= FOUNDED ?></p>
      </div>
      <div data-reveal style="--d:.15s">
        <p class="eyebrow">Our story</p>
        <h2 class="h2">It started with <em>one idea.</em></h2>
        <p class="lead">Concept One began with a question our founders kept asking: why does buying a home have to feel so uncertain? Hidden charges, missed deadlines and plans that look better on paper than they live.</p>
        <p class="lead">So we built a company around the opposite. Clear titles before the first brochure. One honest cost sheet. Layouts drawn for the way families in <?= CITY ?> actually live. And a handover date we treat as a promise, not an estimate.</p>
        <ul class="checks">
          <li><span class="tick"><?= icon('check') ?></span><?= years_active() ?> years building across <?= CITY ?></li>
          <li><span class="tick"><?= icon('check') ?></span>Apartments, villas and Grade-A workspaces</li>
          <li><span class="tick"><?= icon('check') ?></span>In-house design, engineering and customer care</li>
        </ul>
        <a class="link-arrow" href="<?= e(url('projects')) ?>">See what we've built <?= icon('arrow-up-right') ?></a>
      </div>
    </div>

    <div class="mv">
      <article class="mv-card" data-reveal>
        <p class="eyebrow">Our mission</p>
        <h3 class="h3">Homes people are proud to come back to.</h3>
        <p>To design and deliver homes and workspaces that are honest in price, generous in quality and built to stand the test of time, on the date we promise.</p>
      </article>
      <article class="mv-card mv-card--dark on-dark" data-reveal style="--d:.1s">
        <div class="orb" aria-hidden="true"></div>
        <p class="eyebrow">Our vision</p>
        <h3 class="h3">The most trusted name in <?= CITY ?> real estate.</h3>
        <p>Neighbourhoods that grow in value and in community, where every family that buys from us would happily buy from us again.</p>
      </article>
    </div>

    <div class="stats">
      <?php foreach (stats() as $i => $s): ?>
        <div class="stat" data-reveal style="--d:<?= $i * 0.08 ?>s">
          <p class="stat-num"><span data-count="<?= $s['n'] ?>" data-dec="<?= $s['dec'] ?>"><?= number_format((float) $s['n'], $s['dec']) ?></span><sup><?= e($s['suffix']) ?></sup></p>
          <p class="stat-label"><?= e($s['label']) ?></p>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</section>

<section class="section section--sand">
  <div class="container">
    <div class="section-head">
      <div>
        <p class="eyebrow">Our values</p>
        <h2 class="h2">What we <em>stand for.</em></h2>
      </div>
      <p class="lead">Four principles guide every drawing, every contract and every conversation.</p>
    </div>
    <div class="values">
      <?php foreach (VALUES as $i => [$title, $text]): ?>
        <article class="value" data-reveal style="--d:<?= $i * 0.08 ?>s">
          <b><?= sprintf('%02d', $i + 1) ?></b>
          <h3><?= e($title) ?></h3>
          <p><?= e($text) ?></p>
        </article>
      <?php endforeach ?>
    </div>
  </div>
</section>

<section class="section" id="team">
  <div class="container">
    <div class="section-head">
      <div>
        <p class="eyebrow">Leadership</p>
        <h2 class="h2">Meet the people <em>behind the promise.</em></h2>
      </div>
      <p class="lead">A hands-on leadership team that stays close to every site, every buyer and every detail.</p>
    </div>
    <div class="team-grid">
      <?php foreach (TEAM as $i => $m) part('member', ['m' => $m, 'i' => $i, 'bio' => true]) ?>
    </div>
  </div>
</section>

<section class="section section--dark on-dark">
  <div class="container">
    <div class="section-head">
      <div>
        <p class="eyebrow">Milestones</p>
        <h2 class="h2">A journey measured <em>in handovers.</em></h2>
      </div>
    </div>
    <ol class="timeline">
      <?php foreach (TIMELINE as [$year, $title, $text]): ?>
        <li data-reveal>
          <span class="year"><?= e((string) $year) ?></span>
          <div><h3><?= e($title) ?></h3><p><?= e($text) ?></p></div>
        </li>
      <?php endforeach ?>
    </ol>
  </div>
</section>

<?php part('cta') ?>

<?php require ROOT . '/includes/footer.php'; ?>
