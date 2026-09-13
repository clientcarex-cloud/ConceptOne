<div class="cta-wrap">
  <div class="container">
    <div class="cta-band on-dark" data-reveal>
      <div class="orb" aria-hidden="true"></div>
      <div>
        <p class="eyebrow">Your next home</p>
        <h2 class="h2">Your dream home could be <em>our next project.</em></h2>
        <ul class="cta-asks">
          <li>Looking for an affordable home in <?= CITY ?>?</li>
          <li>Looking for a property with flexible payment options?</li>
          <li>Looking for an investment opportunity?</li>
        </ul>
        <p class="cta-close">Let's build your future together.</p>
      </div>
      <div class="cta-actions">
        <a class="btn btn--light" href="<?= e(url('projects')) ?>">Explore Our Projects <?= icon('arrow-right') ?></a>
        <a class="btn btn--ghost" href="<?= e(enquire_url('Schedule a site visit')) ?>"><?= icon('calendar') ?>Schedule a Site Visit</a>
        <a class="btn btn--wa" href="<?= e(wa_link('Hi ConceptOne, I would like to talk to your team.')) ?>" target="_blank" rel="noopener"><?= icon('whatsapp') ?>Talk to Our Team</a>
      </div>
    </div>
  </div>
</div>
