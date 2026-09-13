<?php
require_once __DIR__ . '/includes/bootstrap.php';

$page = [
    'nav'         => 'about',
    'path'        => 'about',
    'title'       => 'About Us — Our Story, Journey & Founders | ' . SITE_NAME,
    'description' => 'From a vision in Jeddah to building dreams in ' . CITY . ': the story of ' . SITE_NAME . ', formerly SmartCity Developers. Our journey, founders, mission, vision and values.',
    'image'       => PHOTOS['hyderabad'],
];
$diamond   = project('diamond-avenue');
$smartcity = project('smartcity-avenue');
[$founder, $cofounder] = FOUNDERS;

$sections = [
    'story'          => 'Our Story',
    'beginning'      => 'The Beginning',
    'first-projects' => 'First Projects',
    'concept'        => 'One Concept',
    'journey'        => 'Our Journey',
    'founders'       => 'Founders & Leadership',
    'mission'        => 'Mission & Values',
    'message'        => "Founders' Message",
];
require ROOT . '/includes/header.php';
?>

<section class="page-hero on-dark">
  <?= photo_img(PHOTOS['hyderabad'], '', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']) ?>
  <div class="container">
    <ol class="crumbs">
      <li><a href="<?= url() ?>">Home</a></li>
      <li aria-current="page">About Us</li>
    </ol>
    <p class="eyebrow">About <?= e(SITE_SHORT) ?></p>
    <h1>Every great journey begins <em>with a vision.</em></h1>
    <p class="lead">Building affordable homes. Creating better communities. Making homeownership easier.</p>
  </div>
</section>

<?php part('subnav', ['sections' => $sections, 'label' => 'About us sections']) ?>

<!-- ============ Our Story ============ -->
<section class="section" id="story">
  <div class="container">
    <div class="story">
      <div class="route on-dark" data-reveal>
        <div class="orb" aria-hidden="true"></div>
        <div class="route-stop">
          <small>Where the vision began</small>
          <strong>Jeddah</strong>
          <span>Saudi Arabia · 12+ years in real estate</span>
        </div>
        <div class="route-line" aria-hidden="true"><?= icon('plane') ?></div>
        <div class="route-stop">
          <small>Where we build dreams</small>
          <strong><?= CITY ?></strong>
          <span>India · Developing homes since <?= FOUNDED ?></span>
        </div>
      </div>

      <div data-reveal style="--d:.15s">
        <p class="eyebrow">Our Story</p>
        <h2 class="h2">From a vision in Jeddah to <em>building dreams in <?= CITY ?>.</em></h2>
        <div class="prose prose--lead">
          <p>Every great journey begins with a vision.</p>
          <p>The journey of <?= e(SITE_NAME) ?> began with its Founder &amp; Director, Mr. <?= e($founder['name']) ?>, a Master's degree holder in Sales &amp; Marketing with over 12 years of real-estate experience in Jeddah, Saudi Arabia.</p>
          <p>After years of experience in the Saudi Arabian real-estate market, he returned to <?= CITY ?> with a dream of building something of his own.</p>
          <p>But when he began searching for his own dream property in <?= CITY ?>, he experienced something that millions of families experience every day.</p>
          <p class="prose-strong">Owning a home was not easy.</p>
          <p>High property prices, complicated processes, expensive home loans and the burden of long-term interest made the dream of owning a home increasingly difficult for ordinary families.</p>
          <p>That personal experience became the foundation of a bigger vision.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="quote-band on-dark">
  <div class="orb" aria-hidden="true"></div>
  <div class="container">
    <figure class="big-quote" data-reveal>
      <blockquote>If buying a home is difficult for us, it must be even harder for thousands of families who spend their entire lives <em>trying to achieve it.</em></blockquote>
      <figcaption>And that is where the journey began.</figcaption>
    </figure>
  </div>
</section>

<!-- ============ The Beginning ============ -->
<section class="section section--sand" id="beginning">
  <div class="container">
    <div class="chapter">
      <div data-reveal>
        <p class="eyebrow">The Beginning</p>
        <h2 class="h2">A simple idea. <em>A bigger mission.</em></h2>
        <div class="prose prose--lead">
          <p>With the intention of making quality homes more accessible to <?= CITY ?>'s growing communities, Mr. <?= e($founder['name']) ?> established his first real-estate development venture under the name:</p>
        </div>
        <p class="namecard">SmartCity Developers</p>
        <div class="prose prose--lead">
          <p>Soon, his brother Mr. <?= e($cofounder['name']) ?>, who also returned from Saudi Arabia with a strong background in Sales &amp; Marketing and rich real-estate experience, joined him.</p>
          <p>Sharing the same values, vision and determination, the brothers began building their journey together.</p>
        </div>
      </div>

      <aside class="objective on-dark" data-reveal style="--d:.15s">
        <div class="orb" aria-hidden="true"></div>
        <p class="eyebrow">The objective was simple</p>
        <p class="objective-text">Build quality homes at affordable prices and make the journey towards homeownership <em>easier for families.</em></p>
        <div class="objective-team">
          <div class="avatars"><?php foreach (FOUNDERS as $f) echo founder_img($f) ?></div>
          <p>Two brothers.<br>One shared vision.</p>
        </div>
      </aside>
    </div>
  </div>
</section>

<!-- ============ First projects ============ -->
<section class="section section--dark on-dark" id="first-projects">
  <div class="container">
    <div class="chapter">
      <div data-reveal>
        <p class="eyebrow">Our First Project</p>
        <h2 class="h2">Diamond <em>Avenue.</em></h2>
        <p class="chapter-loc"><?= icon('map-pin') ?><?= e($diamond['location'] . ', ' . CITY) ?></p>
        <div class="prose prose--lead">
          <p><strong><?= FOUNDED ?> marked a major milestone.</strong> The brothers signed their very first project.</p>
          <p>And soon after, the country entered one of the most challenging periods in modern history.</p>
        </div>
        <p class="chapter-drop">The lockdown.</p>
        <div class="prose prose--lead">
          <p>Businesses were shutting down. Construction activities were disrupted. Movement was restricted. The entire country was facing unprecedented uncertainty.</p>
          <p>But the vision did not stop. The commitment remained.</p>
          <p>Despite the extraordinary circumstances, Mr. <?= e($founder['name']) ?> remained determined to complete the project and deliver it to his customers.</p>
        </div>
        <p class="chapter-drop"><span class="grad-text">And he did.</span></p>
      </div>
      <div data-reveal style="--d:.15s">
        <?php part('factsheet', ['p' => $diamond]) ?>
      </div>
    </div>

    <div class="chapter-close" data-reveal>
      <p>The project was successfully delivered during one of the most challenging periods the country had experienced.</p>
      <p class="chapter-close-big">For <?= e(SITE_SHORT) ?>, Diamond Avenue was more than a project. <em>It was proof that determination can overcome circumstances.</em></p>
      <p>It became the first major milestone in a journey that would go on to create many more homes and communities across <?= CITY ?>.</p>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="chapter chapter--flip">
      <div class="chapter-media" data-reveal>
        <?php part('factsheet', ['p' => $smartcity]) ?>
      </div>
      <div data-reveal style="--d:.15s">
        <p class="eyebrow">Project 02</p>
        <h2 class="h2">SmartCity <em>Avenue.</em></h2>
        <p class="chapter-loc"><?= icon('map-pin') ?><?= e($smartcity['location']) ?></p>
        <div class="prose prose--lead">
          <p>Following the successful delivery of Diamond Avenue, the team continued its journey with its second project.</p>
        </div>
        <p class="chapter-headline">Ground + 5 Floors <span>|</span> <?= e($smartcity['config']) ?></p>
        <ul class="unit-sizes" aria-label="Apartment configurations">
          <?php foreach ($smartcity['units'] as $size): [$num, $unit] = explode(' ', $size, 2); ?>
            <li><strong><?= e($num) ?></strong><?= e($unit) ?></li>
          <?php endforeach ?>
        </ul>
        <div class="prose prose--lead">
          <p>The successful completion of SmartCity Avenue strengthened the team's belief that affordable living spaces could be created without compromising on thoughtful planning and quality.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ The concept changed ============ -->
<section class="section section--sand" id="concept">
  <div class="container">
    <div class="chapter">
      <div data-reveal>
        <p class="eyebrow">The Concept Changed</p>
        <h2 class="h2">From affordable homes to <em>easier homeownership.</em></h2>
        <div class="prose prose--lead">
          <p>As the company continued delivering projects, the founders discovered another challenge.</p>
          <p>Even when homes were made more affordable, many families still struggled with:</p>
        </div>
        <ul class="struggles">
          <?php foreach (CHALLENGES as $c): ?>
            <li><?= icon('x') ?><?= e($c) ?></li>
          <?php endforeach ?>
        </ul>
      </div>
      <div data-reveal style="--d:.15s">
        <div class="question-card on-dark">
          <div class="orb" aria-hidden="true"></div>
          <p>The founders realized that making a home affordable was only one part of the solution. The bigger question was:</p>
          <blockquote>“How can we make owning that home <em>easier?</em>”</blockquote>
          <p class="question-foot">This question led to the next chapter. <?= icon('arrow-right') ?></p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section--dark why on-dark">
  <div class="orb" aria-hidden="true"></div>
  <div class="container">
    <div class="section-head section-head--center">
      <div>
        <p class="eyebrow">The Birth of <?= e(SITE_NAME) ?></p>
        <h2 class="h2">One concept <em>changed everything.</em></h2>
        <p class="lead">In <?= REBRANDED ?>, after successfully delivering their second project, the company evolved from SmartCity Developers into <?= e(SITE_NAME) ?>.</p>
      </div>
    </div>

    <div class="rebrand" data-reveal>
      <div class="rebrand-from"><div><small>Where we began</small><span>SmartCity Developers</span></div></div>
      <span class="rebrand-arrow"><?= icon('arrow-right') ?></span>
      <div class="rebrand-to">
        <img src="<?= asset('assets/img/brand/mark.png') ?>" alt="" width="134" height="122">
        <div><small>Since <?= REBRANDED ?></small><span><?= e(SITE_NAME) ?></span></div>
      </div>
    </div>

    <div class="concept-card" data-reveal>
      <p class="eyebrow">The name represents one fundamental philosophy</p>
      <p class="concept-title"><span class="grad-text">One Concept</span></p>
      <p class="concept-text">Make quality homeownership affordable, accessible and easier for people and communities.</p>
    </div>

    <p class="lead center-lead" data-reveal>The company expanded its vision beyond simply developing properties. <?= e(SITE_NAME) ?> began focusing on creating:</p>
    <?php part('offerings') ?>
    <p class="note note--light"><?= e(PAYMENT_NOTE) ?></p>
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
    <p class="lead journey-intro" data-reveal>Over the last six years, the team has successfully delivered <?= figure('delivered') ?> projects, creating homes and living spaces across some of <?= CITY ?>'s prominent locations.</p>
    <?php part('journey') ?>

    <div class="delivered-list" data-reveal>
      <?php foreach (PROJECTS as $p): ?>
        <a href="<?= e(project_url($p)) ?>"><?= e($p['name']) ?> <span><?= e($p['location']) ?></span></a>
      <?php endforeach ?>
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
      <p class="lead">Two Saudi-returned brothers with backgrounds in Sales &amp; Marketing and real estate, building a company around affordability, trust and customer-centric development.</p>
    </div>
    <div class="founders founders--full">
      <?php foreach (FOUNDERS as $i => $f) part('founder', ['f' => $f, 'i' => 0, 'full' => true]) ?>
    </div>
    <p class="founders-motto" data-reveal>Two Brothers. One Vision. <em>One Concept.</em></p>

    <div class="leadership" id="leadership">
      <div class="section-head">
        <div>
          <p class="eyebrow">Leadership</p>
          <h2 class="h2">Guiding every family <em>home.</em></h2>
        </div>
        <p class="lead">Alongside our founders, our leadership team makes sure every customer's journey is clear, supported and easier from the first visit to the day they move in.</p>
      </div>
      <div class="founders founders--full">
        <?php foreach (LEADERSHIP as $f) part('founder', ['f' => $f, 'i' => 0, 'full' => true]) ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ Mission, vision & values ============ -->
<section class="section" id="mission">
  <div class="container">
    <div class="mv">
      <article class="mv-card" data-reveal>
        <span class="mv-icon"><?= icon('target') ?></span>
        <p class="eyebrow">Our Mission</p>
        <h3 class="h3">Making homeownership easier <em>for everyone.</em></h3>
        <p>Our mission is to develop quality, affordable and thoughtfully designed living spaces for individuals, families and communities across <?= CITY ?>.</p>
        <p>We aim to simplify the home-buying journey by combining:</p>
        <ul class="formula">
          <?php foreach (MISSION_FORMULA as $item): ?><li><?= e($item) ?></li><?php endforeach ?>
        </ul>
      </article>
      <article class="mv-card mv-card--dark on-dark" data-reveal style="--d:.1s">
        <div class="orb" aria-hidden="true"></div>
        <span class="mv-icon"><?= icon('eye') ?></span>
        <p class="eyebrow">Our Vision</p>
        <h3 class="h3">To build more than homes. <em>To build communities.</em></h3>
        <p>We envision a <?= CITY ?> where owning a quality home is not an impossible dream.</p>
        <p>A city where families can find thoughtfully designed homes at accessible prices.</p>
        <p>A future where homeownership is not defined by financial struggle, but by opportunity.</p>
        <p class="mv-close">That is the future we are building.</p>
      </article>
    </div>
  </div>
</section>

<section class="section section--sand" id="values">
  <div class="container">
    <div class="section-head">
      <div>
        <p class="eyebrow">Our Values</p>
        <h2 class="h2">What we <em>stand for.</em></h2>
      </div>
      <p class="lead">Six values guide every home we plan, every promise we make and every family we serve.</p>
    </div>
    <div class="values" data-reveal>
      <?php foreach (VALUES as [$ic, $title, $text]): ?>
        <article class="value">
          <?= icon($ic, 'icon value-icon') ?>
          <h3><?= e($title) ?></h3>
          <p><?= e($text) ?></p>
        </article>
      <?php endforeach ?>
    </div>
  </div>
</section>

<!-- ============ Founders' message ============ -->
<section class="section" id="message">
  <div class="container">
    <article class="letter" data-reveal>
      <div class="letter-side">
        <p class="eyebrow">A Message From Our Founders</p>
        <h2 class="h2">We wanted to <em>solve a problem.</em></h2>
        <div class="avatars avatars--lg"><?php foreach (FOUNDERS as $f) echo founder_img($f) ?></div>
        <p class="letter-motto">One Concept. One Vision. <em>Many Dreams.</em></p>
      </div>

      <div class="letter-body">
        <p class="letter-lede">When we started our journey in <?= CITY ?>, we did not simply want to build another real-estate company.</p>
        <p class="letter-strong">We wanted to solve a problem.</p>
        <p>We experienced first-hand how difficult it can be for an ordinary family to purchase their dream home. The financial burden, rising property prices and long-term loan commitments can make homeownership feel like a distant dream.</p>
        <p>That experience gave us a purpose.</p>
        <p>We started with a simple vision — to create quality homes that more families could afford.</p>
        <p>Our journey began with SmartCity Developers and our very first project, Diamond Avenue. Soon after signing that project, the country entered lockdown. It was a time of uncertainty for everyone. But we chose not to give up on our commitment to our customers.</p>
        <p class="letter-strong">We delivered.</p>
        <p>That experience taught us that success in real estate is not simply about constructing buildings. It is about keeping promises.</p>
        <p>As we continued our journey, we realized that affordability alone was not enough. We wanted to make the process of owning a home easier as well.</p>
        <p>That belief led to the birth of <?= e(SITE_NAME) ?>.</p>
        <p>Today, our concept is simple:</p>
        <p class="letter-concept">Build quality homes. Keep them affordable. Make ownership easier. Build trust for the long term.</p>
        <p>With <?= figure('delivered') ?> projects delivered and <?= STATS['ongoing']['n'] === 4 ? 'four' : STATS['ongoing']['n'] ?> more projects currently underway, we are grateful for every customer, partner and member of our team who has been part of this journey.</p>
        <p>Our journey is still just beginning.</p>
        <div class="signatures">
          <?php foreach (FOUNDERS as $f): ?>
            <p><strong>— <?= e($f['name']) ?></strong><span><?= e($f['role']) ?></span></p>
          <?php endforeach ?>
        </div>
      </div>
    </article>
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

<?php part('cta') ?>

<?php require ROOT . '/includes/footer.php'; ?>
