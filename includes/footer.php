<?php
/** @var array $page */
$socials = array_filter(SOCIAL, fn ($s) => $s[2] !== '#');
?>
</main>

<footer class="site-footer">
  <div class="container">
    <div class="footer-top">
      <p class="display">Let's find your <em>address.</em></p>
      <div class="btn-row">
        <a class="btn btn--light" href="<?= e(url('contact')) ?>#enquire">Book a site visit <?= icon('arrow-right') ?></a>
        <a class="btn btn--ghost" href="tel:<?= PHONE_HREF ?>"><?= icon('phone') ?><?= e(PHONE) ?></a>
      </div>
    </div>

    <div class="footer-grid">
      <div class="footer-brand">
        <img src="<?= asset('assets/img/brand/logo-light.png') ?>" alt="<?= e(SITE_NAME) ?>" width="430" height="160" loading="lazy">
        <p>Apartments, villas and workspaces across <?= CITY ?>, designed around the way you live and delivered on schedule.</p>
        <?php if ($socials): ?>
          <div class="socials">
            <?php foreach ($socials as [$ic, $label, $href]): ?>
              <a href="<?= e($href) ?>" target="_blank" rel="noopener" aria-label="<?= e($label) ?>"><?= icon($ic) ?></a>
            <?php endforeach ?>
          </div>
        <?php endif ?>
      </div>

      <div>
        <h2>Explore</h2>
        <ul>
          <?php foreach (NAV as [$label, $href]): ?>
            <li><a href="<?= e(url($href)) ?>"><?= e($label) ?></a></li>
          <?php endforeach ?>
          <li><a href="<?= e(url('contact')) ?>#enquire">Book a site visit</a></li>
        </ul>
      </div>

      <div>
        <h2>Projects</h2>
        <ul>
          <?php foreach (PROJECTS as $p): ?>
            <li><a href="<?= e(project_url($p)) ?>"><?= e($p['name']) ?></a></li>
          <?php endforeach ?>
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
      <p>RERA registration details are listed on each project page.</p>
    </div>
    <p class="footer-note">Disclaimer: Images are artistic impressions and for representation only. <?= e(PRICE_NOTE) ?> Specifications, amenities and timelines may change. The information on this website does not constitute an offer or contract.</p>
  </div>
  <div class="footer-word" aria-hidden="true">CONCEPT ONE</div>
</footer>

<a class="fab" href="<?= e(wa_link('Hi Concept One, I would like to know more about your projects.')) ?>" target="_blank" rel="noopener" aria-label="Chat with us on WhatsApp"><?= icon('whatsapp') ?></a>

<?php if (!empty($page['lightbox'])): ?>
<dialog class="lightbox" id="lightbox" aria-label="Photo viewer">
  <button class="round-btn round-btn--light lb-close" type="button" data-lb-close aria-label="Close"><?= icon('x') ?></button>
  <button class="round-btn round-btn--light lb-prev" type="button" data-lb-prev aria-label="Previous photo"><?= icon('chevron-left') ?></button>
  <img alt="">
  <button class="round-btn round-btn--light lb-next" type="button" data-lb-next aria-label="Next photo"><?= icon('chevron-right') ?></button>
  <p class="lb-count" data-lb-count></p>
</dialog>
<?php endif ?>

<script src="<?= asset('assets/js/main.js') ?>" defer></script>
</body>
</html>
