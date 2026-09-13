<?php /** A project's fact sheet card. @var array $p  a PROJECTS entry with facts */ ?>
<div class="factsheet">
  <div class="factsheet-media">
    <?= photo_img($p['cover'], '', '(max-width: 960px) 90vw, 40vw') ?>
    <span class="badge badge--<?= e($p['status']) ?>"><?= e(STATUSES[$p['status']]) ?></span>
  </div>
  <div class="factsheet-body">
    <?php if (!empty($p['chapter'])): ?>
      <p class="factsheet-kicker"><?= e($p['chapter']) ?></p>
    <?php endif ?>
    <h3><?= e($p['name']) ?></h3>
    <dl class="facts-list">
      <?php foreach ($p['facts'] as $label => $value): ?>
        <div><dt><?= e($label) ?></dt><dd><?= e($value) ?></dd></div>
      <?php endforeach ?>
      <?php if (!empty($p['units'])): ?>
        <div><dt>Sizes</dt><dd><?= e(implode(' · ', $p['units'])) ?></dd></div>
      <?php endif ?>
      <div><dt>Location</dt><dd><?= e($p['location'] . ', ' . CITY) ?></dd></div>
    </dl>
    <a class="link-arrow" href="<?= e(project_url($p)) ?>">View project <?= icon('arrow-up-right') ?></a>
  </div>
</div>
