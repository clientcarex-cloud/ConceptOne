<?php
require_once __DIR__ . '/includes/bootstrap.php';

$form = ['errors' => [], 'values' => [], 'sent' => isset($_GET['sent'])];
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $form = handle_enquiry() + $form; // redirects on success
}

$page = [
    'nav'         => 'contact',
    'path'        => 'contact',
    'title'       => 'Contact Us & Book a Site Visit | ' . SITE_NAME,
    'description' => 'Book a site visit, request a brochure or talk to the ' . SITE_NAME . ' sales team. Call, WhatsApp or send us an enquiry.',
    'image'       => PHOTOS['contact_hero'],
];
require ROOT . '/includes/header.php';
?>

<section class="page-hero page-hero--short page-hero--cards on-dark">
  <?= photo_img(PHOTOS['contact_hero'], '', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']) ?>
  <div class="container">
    <ol class="crumbs">
      <li><a href="<?= url() ?>">Home</a></li>
      <li aria-current="page">Contact</li>
    </ol>
    <h1>Contact <em>Us.</em></h1>
    <p class="lead">Book a site visit, request a brochure or simply ask a question. Our sales team will get back to you soon.</p>
  </div>
</section>

<div class="container">
  <div class="contact-cards">
    <div class="contact-card" data-reveal>
      <span class="ic"><?= icon('phone') ?></span><small>Call us</small>
      <strong><?php foreach (phones() as $i => [$label, $href]): ?><a href="tel:<?= e($href) ?>"><?= e($label) ?></a><?= $i === 0 ? '<br>' : '' ?><?php endforeach ?></strong>
    </div>
    <a class="contact-card" href="<?= e(wa_link('Hi Concept One, I have a question.')) ?>" target="_blank" rel="noopener" data-reveal style="--d:.08s">
      <span class="ic"><?= icon('whatsapp') ?></span><small>WhatsApp</small><strong>Chat with sales</strong>
    </a>
    <a class="contact-card" href="mailto:<?= EMAIL ?>" data-reveal style="--d:.16s">
      <span class="ic"><?= icon('mail') ?></span><small>Email</small><strong><?= e(EMAIL) ?></strong>
    </a>
    <div class="contact-card" data-reveal style="--d:.24s">
      <span class="ic"><?= icon('clock') ?></span><small>Open</small><strong><?= e(HOURS) ?></strong>
    </div>
  </div>
</div>

<section class="section section--tight" id="enquire">
  <div class="container contact-grid">
    <div class="form-card">
      <?php if ($form['sent']): ?>
        <div class="notice notice--ok" role="status"><?= icon('check') ?><span>Thank you. We've received your enquiry, and a member of our team will be in touch shortly.</span></div>
      <?php endif ?>
      <p class="eyebrow">Enquire</p>
      <h2 class="h2">Book a visit or <em>ask us anything.</em></h2>
      <p class="lead">Share a few details and we'll prepare a shortlist, a cost sheet and a convenient visit slot for you.</p>
      <?php part('enquiry-form', ['form' => $form]) ?>
    </div>

    <div class="sticky-col">
      <div class="info-card on-dark">
        <div class="orb" aria-hidden="true"></div>
        <h3>Sales &amp; experience centre</h3>
        <p>Walk in to see material samples and show-apartment finishes, or let us bring you to the site.</p>
        <ul class="info-list">
          <li><?= icon('map-pin') ?><div><small>Address</small><?= implode('<br>', array_map('e', ADDRESS)) ?></div></li>
          <li><?= icon('clock') ?><div><small>Hours</small><?= e(HOURS) ?></div></li>
          <li><?= icon('phone') ?><div><small>Phone</small><?php foreach (phones() as $i => [$label, $href]): ?><?= $i ? '<br>' : '' ?><a href="tel:<?= e($href) ?>"><?= e($label) ?></a><?php endforeach ?></div></li>
          <li><?= icon('mail') ?><div><small>Email</small><a href="mailto:<?= EMAIL ?>"><?= e(EMAIL) ?></a></div></li>
        </ul>
        <a class="btn btn--wa btn--block" href="<?= e(wa_link('Hi Concept One, I would like to book a site visit.')) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?>Book on WhatsApp</a>
      </div>
      <div class="map" style="margin-top:0">
        <iframe title="Map of <?= e(MAP_QUERY) ?>" src="https://maps.google.com/maps?q=<?= rawurlencode(MAP_QUERY) ?>&amp;z=12&amp;output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </div>
</section>

<section class="section section--sand">
  <div class="container" style="max-width:920px">
    <div class="section-head section-head--center">
      <div>
        <p class="eyebrow">FAQs</p>
        <h2 class="h2">Questions, <em>answered.</em></h2>
      </div>
    </div>
    <div class="accordion">
      <?php foreach (FAQS as $i => [$q, $a]): ?>
        <details<?= $i === 0 ? ' open' : '' ?>>
          <summary><?= e($q) ?><?= icon('plus') ?></summary>
          <p><?= e($a) ?></p>
        </details>
      <?php endforeach ?>
    </div>
  </div>
</section>

<?php require ROOT . '/includes/footer.php'; ?>
