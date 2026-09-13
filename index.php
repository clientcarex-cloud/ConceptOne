<?php
require_once __DIR__ . '/includes/bootstrap.php';

$page = [
    'nav'         => 'home',
    'path'        => '',
    'title'       => SITE_NAME . ' — Affordable Homes in ' . CITY . ' | ' . TAGLINE,
    'description' => SITE_NAME . ' builds quality, affordable homes across ' . CITY . ' with flexible payment solutions. ' . figure('delivered') . ' projects delivered and ' . figure('ongoing') . ' under development. Explore our projects or talk to us.',
    'image'       => PHOTOS['hero'],
];
$founder = FOUNDERS[0];
require ROOT . '/includes/header.php';
?>

<!-- ============ Hero ============ -->
<section class="hero on-dark">
  <div class="hero-media"><?= photo_img(PHOTOS['hero'], '', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']) ?></div>

  <div class="container hero-inner">
    <p class="eyebrow"><?= e(SITE_NAME) ?> · <?= CITY ?></p>
    <h1 class="display">One Concept. One Vision.<br> <em>Your Dream Home.</em></h1>
    <p class="hero-sub">Building affordable homes. Creating better communities. Making homeownership easier.</p>
    <p class="lead">At <?= e(SITE_NAME) ?>, we believe that owning a home should not remain a lifelong struggle or an impossible dream.</p>
    <div class="hero-ctas">
      <a class="btn btn--light" href="<?= e(url('projects')) ?>">Explore Our Projects <?= icon('arrow-right') ?></a>
      <a class="btn btn--ghost" href="<?= e(enquire_url()) ?>">Talk to Us</a>
    </div>

    <div class="hero-foot">
      <ul class="hero-stats">
        <li><strong><?= STATS['delivered']['n'] ?></strong><span>Projects Delivered</span></li>
        <li><strong><?= STATS['years']['n'] ?><sup>+</sup></strong><span>Years of Development</span></li>
        <li><strong><?= STATS['ongoing']['n'] ?><sup>+</sup></strong><span>Ongoing Projects</span></li>
      </ul>
      <p class="hero-note">Founded with a vision to make quality homes more accessible to families in <?= CITY ?>, <?= e(SITE_NAME) ?> combines real-estate experience, thoughtful planning, quality construction and customer-focused payment solutions to create spaces people are proud to call home.</p>
    </div>
  </div>
</section>

<!-- ============ Ticker ============ -->
<?php $ticker = ['Affordable living spaces', 'Quality construction', 'Transparent processes', 'Flexible EMI options', 'Easier ownership', 'Investment opportunities', 'Building communities in ' . CITY]; ?>
<div class="ticker" aria-label="What we stand for">
  <div class="ticker-track">
    <?php foreach ([false, true] as $dup): ?>
      <?php foreach ($ticker as $t): ?>
        <span class="ticker-item"<?= $dup ? ' aria-hidden="true"' : '' ?>><?= e($t) ?></span>
      <?php endforeach ?>
    <?php endforeach ?>
  </div>
</div>

<!-- ============ Our Story ============ -->
<section class="section" id="story">
  <div class="container">
    <div class="intro-grid">
      <div class="collage" data-reveal>
        <div class="collage-main"><?= photo_img(PHOTOS['hyderabad'], 'The Charminar in Hyderabad', '(max-width: 960px) 90vw, 46vw') ?></div>
        <div class="collage-small"><?= founder_img($founder) ?></div>
        <div class="seal" aria-hidden="true">
          <svg class="seal-ring" viewBox="0 0 120 120">
            <defs><path id="seal-path" d="M60,60 m-48,0 a48,48 0 1,1 96,0 a48,48 0 1,1 -96,0"/></defs>
            <text textLength="298" lengthAdjust="spacing"><textPath href="#seal-path">ConceptOne · Developers · Since <?= FOUNDED ?> ·</textPath></text>
          </svg>
          <img src="<?= asset('assets/img/brand/mark.png') ?>" alt="" width="134" height="122">
        </div>
      </div>

      <div class="intro-copy" data-reveal style="--d:.15s">
        <p class="eyebrow">Our Story</p>
        <h2 class="h2">From a vision in Jeddah to <em>building dreams in <?= CITY ?>.</em></h2>
        <p class="lead">Every great journey begins with a vision. Ours began with our Founder &amp; Director, Mr. <?= e($founder['name']) ?>, who returned to <?= CITY ?> after over 12 years in real estate in Jeddah, Saudi Arabia, with a dream of building something of his own.</p>
        <p class="lead">When he began searching for his own dream property, he experienced what millions of families experience every day. High prices, complicated processes, expensive home loans and long-term interest: owning a home was not easy.</p>
        <blockquote class="pull">“If buying a home is difficult for us, it must be even harder for thousands of families who spend their entire lives trying to achieve it.”</blockquote>
        <p class="pull-foot">And that is where the journey began.</p>
        <a class="link-arrow" href="<?= e(url('about#story')) ?>">Read our full story <?= icon('arrow-up-right') ?></a>
      </div>
    </div>
  </div>
</section>

<!-- ============ Why ConceptOne ============ -->
<section class="section section--dark why on-dark" id="why">
  <div class="orb" aria-hidden="true"></div>
  <div class="container">
    <div class="section-head">
      <div>
        <p class="eyebrow">Why <?= e(SITE_SHORT) ?>?</p>
        <h2 class="h2">Because a home is more than <em>four walls.</em></h2>
      </div>
      <p class="lead">Buying a home is one of the biggest decisions a family makes. We understand the emotion, financial commitment and trust involved. That is why every <?= e(SITE_SHORT) ?> project is built around four principles.</p>
    </div>
    <div class="features features--4">
      <?php foreach (PRINCIPLES as $i => [$ic, $title, $text]): ?>
        <article class="feature" data-reveal style="--d:<?= $i * 0.08 ?>s">
          <span class="feature-num"><?= sprintf('%02d', $i + 1) ?></span>
          <div class="feature-icon"><?= icon($ic) ?></div>
          <h3><?= e($title) ?></h3>
          <p><?= e($text) ?></p>
        </article>
      <?php endforeach ?>
    </div>
    <div class="why-foot" data-reveal>
      <p><strong>No Cost EMI on <?= NO_COST_EMI_SHARE ?>% of the price</strong>, directly from <?= e(SITE_SHORT) ?>, alongside installment options designed to make ownership easier.</p>
      <a class="link-arrow" href="<?= e(url('projects#ownership')) ?>">See payment options <?= icon('arrow-up-right') ?></a>
    </div>
  </div>
</section>

<!-- ============ Our Projects ============ -->
<section class="section section--sand" id="projects">
  <div class="container">
    <div class="section-head">
      <div>
        <p class="eyebrow">Our Projects</p>
        <h2 class="h2">Spaces built <em>with purpose.</em></h2>
      </div>
      <p class="lead">A selection of the <?= figure('delivered') ?> projects we have delivered, creating homes and living spaces across some of <?= CITY ?>'s prominent locations.</p>
    </div>
    <div class="grid-projects">
      <?php foreach (projects_by_slug(HOME_PROJECTS) as $i => $p) part('project-card', ['p' => $p, 'i' => $i]) ?>
    </div>
    <div class="center mt-cta">
      <a class="btn btn--dark" href="<?= e(url('projects')) ?>">Explore Our Projects <?= icon('arrow-right') ?></a>
    </div>
  </div>
</section>

<!-- ============ Our Journey ============ -->
<section class="section" id="journey">
  <div class="container">
    <div class="section-head">
      <div>
        <p class="eyebrow">Our Journey</p>
        <h2 class="h2"><?= figure('years') ?> years. <?= figure('delivered') ?> projects. <em>One unchanging vision.</em></h2>
      </div>
      <div class="motto-block">
        <p class="lead">From our first project in <?= FOUNDED ?> to today, <?= e(SITE_NAME) ?> has grown through one principle:</p>
        <p class="motto">Deliver what we promise.</p>
      </div>
    </div>
    <?php part('journey') ?>
    <div class="center mt-cta">
      <a class="link-arrow" href="<?= e(url('about#journey')) ?>">Read the full journey <?= icon('arrow-up-right') ?></a>
    </div>
  </div>
</section>

<!-- ============ Our Founders ============ -->
<section class="section section--dark on-dark" id="founders">
  <div class="container">
    <div class="section-head">
      <div>
        <p class="eyebrow">Our Founders</p>
        <h2 class="h2">The people behind <em>the vision.</em></h2>
      </div>
      <a class="link-arrow" href="<?= e(url('about#founders')) ?>">Meet our founders &amp; leadership <?= icon('arrow-up-right') ?></a>
    </div>
    <div class="founders">
      <?php foreach (FOUNDERS as $i => $f) part('founder', ['f' => $f, 'i' => $i]) ?>
    </div>
    <p class="founders-motto" data-reveal>Two Brothers. One Vision. <em>One Concept.</em></p>

    <div class="leadership" id="leadership">
      <p class="eyebrow">Leadership</p>
      <div class="founders founders--single">
        <?php foreach (LEADERSHIP as $i => $f) part('founder', ['f' => $f, 'i' => $i]) ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ Our Numbers ============ -->
<section class="section section--sand">
  <div class="container">
    <div class="section-head section-head--center">
      <div>
        <p class="eyebrow">Our Numbers</p>
        <h2 class="h2">The journey <em>in numbers.</em></h2>
      </div>
    </div>
    <?php part('stats', ['keys' => array_keys(STATS)]) ?>
  </div>
</section>

<!-- ============ Ongoing Projects ============ -->
<section class="section" id="ongoing">
  <div class="container">
    <div class="spotlight on-dark" data-reveal>
      <?= photo_img(PHOTOS['construction'], '', '(max-width: 1320px) 100vw, 1320px') ?>
      <div class="spotlight-body">
        <p class="eyebrow">Our Present Projects</p>
        <h2 class="h2">The journey <em>continues.</em></h2>
        <p class="lead">We are not stopping at what we have already achieved. Today, <?= e(SITE_NAME) ?> is actively working on <?= STATS['ongoing']['n'] ?> new projects across <?= CITY ?>. Each new development is an opportunity to improve upon what we have built before.</p>
        <ul class="ongoing-lines">
          <li>New locations. New communities. Same vision.</li>
          <li>Affordable homes. Thoughtful spaces. <em>Easier ownership.</em></li>
        </ul>
        <div class="btn-row">
          <a class="btn btn--light" href="<?= e(url('projects#ongoing')) ?>">View Ongoing Projects <?= icon('arrow-right') ?></a>
          <a class="btn btn--ghost" href="<?= e(enquire_url('Ongoing projects')) ?>">Register your interest</a>
        </div>
      </div>
      <p class="spotlight-count" aria-hidden="true"><?= sprintf('%02d', STATS['ongoing']['n']) ?></p>
    </div>
  </div>
</section>

<?php part('cta') ?>

<?php require ROOT . '/includes/footer.php'; ?>
