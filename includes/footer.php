<?php
/** @var array $page */
$socials = array_filter(SOCIAL, fn ($s) => $s[2] !== '#');
?>
</main>

<footer class="site-footer">
  <div class="container">
    <div class="footer-top">
      <p class="display">One Concept. One Vision. <em>Your Dream Home.</em></p>
      <div class="btn-row">
        <a class="btn btn--light" href="<?= e(enquire_url('Schedule a site visit')) ?>">Schedule a site visit <?= icon('arrow-right') ?></a>
        <a class="btn btn--ghost" href="tel:<?= PHONE_HREF ?>"><?= icon('phone') ?><?= e(PHONE) ?></a>
      </div>
    </div>

    <div class="footer-grid">
      <div class="footer-brand">
        <img src="<?= asset('assets/img/brand/logo-light.png') ?>" alt="<?= e(SITE_NAME) ?>" width="430" height="160" loading="lazy">
        <p>Building affordable homes. Creating better communities. Making homeownership easier.</p>
        <p class="footer-since">Building in <?= CITY ?> since <?= FOUNDED ?> · Formerly SmartCity Developers</p>
        <?php if ($socials): ?>
          <div class="socials">
            <?php foreach ($socials as [$ic, $label, $href]): ?>
              <a href="<?= e($href) ?>" target="_blank" rel="noopener" aria-label="<?= e($label) ?>"><?= icon($ic) ?></a>
            <?php endforeach ?>
          </div>
        <?php endif ?>
      </div>

      <div>
        <h2>Company</h2>
        <ul>
          <li><a href="<?= e(url(NAV['about'][1])) ?>"><?= e(NAV['about'][0]) ?></a></li>
          <?php foreach (NAV['about'][2] as [$label, $href]): ?>
            <li><a href="<?= e(url($href)) ?>"><?= e($label) ?></a></li>
          <?php endforeach ?>
          <li><a href="<?= e(url(NAV['why'][1])) ?>"><?= e(NAV['why'][0]) ?></a></li>
          <li><a href="<?= e(url('contact')) ?>">Contact</a></li>
        </ul>
      </div>

      <div>
        <h2>Projects</h2>
        <ul>
          <?php foreach (PROJECTS as $p): ?>
            <li><a href="<?= e(project_url($p)) ?>"><?= e($p['name']) ?></a></li>
          <?php endforeach ?>
          <li><a href="<?= e(url('projects#ongoing')) ?>">Ongoing projects</a></li>
        </ul>
      </div>

      <div>
        <h2>Get in touch</h2>
        <ul class="footer-contact">
          <?php foreach (phones() as [$label, $href]): ?>
            <li><?= icon('phone') ?><a href="tel:<?= e($href) ?>"><?= e($label) ?></a></li>
          <?php endforeach ?>
          <li><?= icon('mail') ?><a href="mailto:<?= EMAIL ?>"><?= e(EMAIL) ?></a></li>
          <li><?= icon('whatsapp') ?><a href="<?= e(wa_link()) ?>" target="_blank" rel="noopener">Chat on WhatsApp</a></li>
          <li><?= icon('map-pin') ?><span><?= implode('<br>', array_map('e', ADDRESS)) ?></span></li>
          <li><?= icon('clock') ?><span><?= e(HOURS) ?></span></li>
        </ul>
      </div>
    </div>

    <div class="footer-bottom">
      <p>© <?= date('Y') ?> <?= e(SITE_NAME) ?>. All rights reserved.</p>
      <p><?= e(TAGLINE) ?></p>
      <p class="footer-credit">Developed by <a href="https://clientcarex.com/" target="_blank" rel="noopener">ClientCareX</a></p>
    </div>
    <p class="footer-note">Disclaimer: Photographs on this website are representative and may not depict the actual projects. <?= e(PAYMENT_NOTE) ?> The information on this website does not constitute an offer or contract.</p>
  </div>
  <div class="footer-word" aria-hidden="true">CONCEPTONE</div>
</footer>

<a class="fab" href="<?= e(wa_link('Hi ConceptOne, I would like to know more about your projects.')) ?>" target="_blank" rel="noopener" aria-label="Chat with us on WhatsApp"><?= icon('whatsapp') ?></a>

<script src="<?= asset('assets/js/main.js') ?>" defer></script>
</body>
</html>
