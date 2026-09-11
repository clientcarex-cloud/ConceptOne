<?php
require_once __DIR__ . '/includes/bootstrap.php';

$page = [
    'nav'         => 'home',
    'path'        => '',
    'title'       => 'Concept One Developers — Premium Apartments, Villas & Commercial Spaces in ' . CITY,
    'description' => 'Thoughtfully designed apartments, villas and Grade-A workspaces across ' . CITY . ', with transparent pricing and on-schedule handovers. Explore projects and book a site visit.',
    'image'       => HERO_SLIDES[0][0],
];
$spot = project('aurum-villas');
require ROOT . '/includes/header.php';
?>

<!-- ============ Hero ============ -->
<section class="hero on-dark" data-slider>
  <div class="hero-slides">
    <?php foreach (HERO_SLIDES as $i => [$img, $slug]): $p = project($slug); ?>
      <div class="hero-slide<?= $i === 0 ? ' is-active' : '' ?>" data-name="<?= e($p['name']) ?>" data-loc="<?= e($p['config'] . ' · ' . $p['location']) ?>" data-href="<?= e(project_url($p)) ?>">
        <?= photo_img($img, '', '100vw', $i === 0 ? ['loading' => 'eager', 'fetchpriority' => 'high'] : []) ?>
      </div>
    <?php endforeach ?>
  </div>

  <div class="container hero-inner">
    <p class="eyebrow"><?= e(SITE_NAME) ?> · <?= CITY ?></p>
    <h1 class="display">Built for the life <em>you're building.</em></h1>
    <p class="lead">Apartments, villas and workspaces across <?= CITY ?>, planned around light, air and everyday living. Delivered on schedule, with nothing hidden in the fine print.</p>
    <div class="hero-ctas">
      <a class="btn btn--light" href="<?= e(url('projects')) ?>">Explore projects <?= icon('arrow-right') ?></a>
      <a class="btn btn--ghost" href="<?= e(url('contact')) ?>#enquire">Book a site visit</a>
    </div>

    <div class="hero-foot">
      <form class="search" action="<?= e(url('projects')) ?>" method="get" role="search" aria-label="Find a property">
        <div class="search-field">
          <label for="s-loc">Location</label>
          <select id="s-loc" name="loc">
            <option value="">All locations</option>
            <?php foreach (locations() as $loc): ?><option><?= e($loc) ?></option><?php endforeach ?>
          </select>
        </div>
        <div class="search-field">
          <label for="s-type">Property type</label>
          <select id="s-type" name="type">
            <option value="">All types</option>
            <?php foreach (TYPES as $t): ?><option><?= e($t) ?></option><?php endforeach ?>
          </select>
        </div>
        <div class="search-field">
          <label for="s-budget">Budget</label>
          <select id="s-budget" name="budget">
            <option value="">Any budget</option>
            <?php foreach (BUDGETS as $k => [$label]): ?><option value="<?= e($k) ?>"><?= e($label) ?></option><?php endforeach ?>
          </select>
        </div>
        <button class="btn btn--grad" type="submit"><?= icon('search') ?>Search</button>
      </form>

      <div>
        <div class="hero-meta">
          <?php $first = project(HERO_SLIDES[0][1]) ?>
          <a class="hero-caption" data-slide-caption href="<?= e(project_url($first)) ?>">
            <small>Now showing</small>
            <strong><?= e($first['name']) ?></strong>
            <span><?= e($first['config'] . ' · ' . $first['location']) ?></span>
          </a>
          <p class="hero-count"><b data-slide-index>01</b> / <?= sprintf('%02d', count(HERO_SLIDES)) ?></p>
          <div class="hero-arrows">
            <button class="round-btn round-btn--light" type="button" data-slide-prev aria-label="Previous slide"><?= icon('chevron-left') ?></button>
            <button class="round-btn round-btn--light" type="button" data-slide-next aria-label="Next slide"><?= icon('chevron-right') ?></button>
          </div>
        </div>
        <div class="hero-progress" aria-hidden="true"><span></span></div>
      </div>
    </div>
  </div>
</section>

<!-- ============ Ticker ============ -->
<?php $ticker = ['Clear titles & approvals', 'Handovers on schedule', 'Vastu-aligned homes', 'One honest cost sheet', 'No Cost EMI on ' . NO_COST_EMI_SHARE . '%', 'After-sales care', 'Built in ' . CITY]; ?>
<div class="ticker" aria-label="Our commitments">
  <div class="ticker-track">
    <?php foreach ([false, true] as $dup): ?>
      <?php foreach ($ticker as $t): ?>
        <span class="ticker-item"<?= $dup ? ' aria-hidden="true"' : '' ?>><?= e($t) ?></span>
      <?php endforeach ?>
    <?php endforeach ?>
  </div>
</div>

<!-- ============ Intro ============ -->
<section class="section" id="about">
  <div class="container">
    <div class="intro-grid">
      <div class="collage" data-reveal>
        <div class="collage-main"><?= photo_img(PHOTOS['intro_main'], 'Sunlit living room with a floating staircase', '(max-width: 960px) 90vw, 46vw') ?></div>
        <div class="collage-small"><?= photo_img(PHOTOS['intro_small'], 'Contemporary home exterior', '(max-width: 960px) 45vw, 23vw') ?></div>
        <div class="seal" aria-hidden="true">
          <svg class="seal-ring" viewBox="0 0 120 120">
            <defs><path id="seal-path" d="M60,60 m-48,0 a48,48 0 1,1 96,0 a48,48 0 1,1 -96,0"/></defs>
            <text textLength="298" lengthAdjust="spacing"><textPath href="#seal-path">Concept One · Developers · Est. <?= FOUNDED ?> ·</textPath></text>
          </svg>
          <img src="<?= asset('assets/img/brand/mark.png') ?>" alt="" width="134" height="122">
        </div>
      </div>

      <div class="intro-copy" data-reveal style="--d:.15s">
        <p class="eyebrow">Who we are</p>
        <h2 class="h2">We don't just build homes. We build <em>trust</em>, one handover at a time.</h2>
        <p class="lead">For <?= years_active() ?> years, <?= e(SITE_NAME) ?> has shaped some of <?= CITY ?>'s most livable addresses: homes planned around natural light, cross-ventilation and the everyday rhythms of family life.</p>
        <ul class="checks">
          <li><span class="tick"><?= icon('check') ?></span>Legally vetted land and every approval on file</li>
          <li><span class="tick"><?= icon('check') ?></span>Monthly construction updates, from foundation to handover</li>
          <li><span class="tick"><?= icon('check') ?></span>A single relationship manager from your first visit to your keys</li>
        </ul>
        <a class="link-arrow" href="<?= e(url('about')) ?>">Discover our story <?= icon('arrow-up-right') ?></a>
      </div>
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

<!-- ============ Featured projects ============ -->
<section class="section section--sand" id="projects">
  <div class="container">
    <div class="section-head">
      <div>
        <p class="eyebrow">Portfolio</p>
        <h2 class="h2">Addresses worth <em>coming home to.</em></h2>
      </div>
      <div class="tabs" role="group" aria-label="Filter projects by status" data-filter-tabs="#home-projects">
        <button class="tab" type="button" data-status="" aria-pressed="true">All</button>
        <button class="tab" type="button" data-status="ongoing" aria-pressed="false">Ongoing</button>
        <button class="tab" type="button" data-status="upcoming" aria-pressed="false">Upcoming</button>
        <button class="tab" type="button" data-status="completed" aria-pressed="false">Completed</button>
      </div>
    </div>

    <div class="grid-projects" id="home-projects">
      <?php foreach (PROJECTS as $i => $p) part('project-card', ['p' => $p, 'i' => $i]) ?>
    </div>

    <div class="center mt-cta">
      <a class="btn btn--dark" href="<?= e(url('projects')) ?>">Browse all projects <?= icon('arrow-right') ?></a>
    </div>
  </div>
</section>

<!-- ============ Why us ============ -->
<section class="section section--dark why on-dark">
  <div class="orb" aria-hidden="true"></div>
  <div class="container">
    <div class="section-head">
      <div>
        <p class="eyebrow">Why <?= e(SITE_SHORT) ?></p>
        <h2 class="h2">Six promises we put <em>in writing.</em></h2>
      </div>
      <p class="lead">Buying a home should feel exciting, not uncertain. These commitments are part of every project we build.</p>
    </div>
    <div class="features">
      <?php foreach (FEATURES as $i => [$ic, $title, $text]): ?>
        <article class="feature" data-reveal style="--d:<?= ($i % 3) * 0.08 ?>s">
          <span class="feature-num"><?= sprintf('%02d', $i + 1) ?></span>
          <div class="feature-icon"><?= icon($ic) ?></div>
          <h3><?= e($title) ?></h3>
          <p><?= e($text) ?></p>
        </article>
      <?php endforeach ?>
    </div>
  </div>
</section>

<!-- ============ Spotlight ============ -->
<section class="section">
  <div class="container">
    <div class="spotlight on-dark" data-reveal>
      <?= photo_img(PHOTOS['spotlight'], $spot['name'] . ' at dusk', '(max-width: 1320px) 100vw, 1320px') ?>
      <div class="spotlight-body">
        <p class="eyebrow">Signature project · <?= e($spot['location']) ?></p>
        <h2 class="h2"><?= e($spot['name']) ?>. <em>Private by design.</em></h2>
        <p class="lead"><?= e($spot['summary']) ?></p>
        <div class="spec-grid">
          <?php foreach ($spot['specs'] as $label => $value): ?>
            <div class="spec"><strong><?= e($value) ?></strong><span><?= e($label) ?></span></div>
          <?php endforeach ?>
        </div>
        <div class="chips">
          <?php foreach (array_slice($spot['amenities'], 0, 5) as $a): ?><span class="chip"><?= e(AMENITY_SET[$a]) ?></span><?php endforeach ?>
        </div>
        <div class="btn-row">
          <a class="btn btn--light" href="<?= e(project_url($spot)) ?>">Explore <?= e($spot['name']) ?> <?= icon('arrow-right') ?></a>
          <a class="btn btn--ghost" href="<?= e(url('contact?interest=' . rawurlencode($spot['name'] . ' — ' . $spot['location']))) ?>#enquire"><?= icon('download') ?>Request brochure</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ Process ============ -->
<section class="section section--sand">
  <div class="container">
    <div class="section-head">
      <div>
        <p class="eyebrow">How it works</p>
        <h2 class="h2">From first visit <em>to front door.</em></h2>
      </div>
      <a class="link-arrow" href="<?= e(url('contact')) ?>#enquire">Start with a conversation <?= icon('arrow-up-right') ?></a>
    </div>
    <ol class="steps">
      <?php foreach (STEPS as $i => [$title, $text]): ?>
        <li class="step" data-reveal style="--d:<?= $i * 0.08 ?>s">
          <span class="step-num"><?= $i + 1 ?></span>
          <h3><?= e($title) ?></h3>
          <p><?= e($text) ?></p>
        </li>
      <?php endforeach ?>
    </ol>
  </div>
</section>

<!-- ============ No Cost EMI ============ -->
<section class="section" id="emi">
  <div class="container emi">
    <div class="emi-copy" data-reveal>
      <p class="eyebrow">No Cost EMI</p>
      <h2 class="h2">Own it sooner. <em>Pay zero interest.</em></h2>
      <p class="lead">We offer No Cost EMI on <?= NO_COST_EMI_SHARE ?>% of your home's price, directly from <?= e(SITE_SHORT) ?>. Spread that <?= NO_COST_EMI_SHARE ?>% across easy monthly instalments and pay no interest on it.</p>
      <ul class="checks">
        <li><span class="tick"><?= icon('check') ?></span>No interest and no bank involved</li>
        <li><span class="tick"><?= icon('check') ?></span>Tenures from <?= NO_COST_EMI_MIN_MONTHS ?> to <?= NO_COST_EMI_MAX_MONTHS ?> months</li>
        <li><span class="tick"><?= icon('check') ?></span>The balance <?= 100 - NO_COST_EMI_SHARE ?>% follows the project's payment schedule</li>
      </ul>
    </div>
    <div data-reveal style="--d:.15s">
      <?php part('emi', ['price' => 12000000]) ?>
    </div>
  </div>
</section>

<!-- ============ Team ============ -->
<section class="section section--dark on-dark">
  <div class="container">
    <div class="section-head">
      <div>
        <p class="eyebrow">Leadership</p>
        <h2 class="h2">The people behind <em>the promise.</em></h2>
      </div>
      <a class="link-arrow" href="<?= e(url('about')) ?>#team">Meet the team <?= icon('arrow-up-right') ?></a>
    </div>
    <div class="team-grid">
      <?php foreach (TEAM as $i => $m) part('member', ['m' => $m, 'i' => $i]) ?>
    </div>
  </div>
</section>

<!-- ============ Testimonials ============ -->
<section class="section">
  <div class="container">
    <div class="quotes" data-quotes>
      <p class="eyebrow">Homeowner stories</p>
      <div class="stars" aria-hidden="true"><?= str_repeat(icon('star'), 5) ?></div>
      <?php foreach (TESTIMONIALS as $i => [$text, $name, $role]): ?>
        <figure class="quote<?= $i === 0 ? ' is-active' : '' ?>">
          <blockquote><?= e($text) ?></blockquote>
          <figcaption class="quote-by">
            <div class="avatar" aria-hidden="true"><?= e(mb_substr($name, 0, 1)) ?></div>
            <div><strong><?= e($name) ?></strong><span><?= e($role) ?></span></div>
          </figcaption>
        </figure>
      <?php endforeach ?>
      <div class="quotes-nav">
        <button class="round-btn" type="button" data-quote-prev aria-label="Previous testimonial"><?= icon('chevron-left') ?></button>
        <div class="dots">
          <?php foreach (TESTIMONIALS as $i => $_): ?>
            <button class="dot" type="button" aria-label="Show testimonial <?= $i + 1 ?>" aria-current="<?= $i === 0 ? 'true' : 'false' ?>"></button>
          <?php endforeach ?>
        </div>
        <button class="round-btn" type="button" data-quote-next aria-label="Next testimonial"><?= icon('chevron-right') ?></button>
      </div>
    </div>
  </div>
</section>

<?php part('cta') ?>

<?php require ROOT . '/includes/footer.php'; ?>
