<?php
/** @var array $p  a PROJECTS entry  @var int $i  position, for the reveal stagger */
?>
<article class="card" data-reveal style="--d:<?= (($i ?? 0) % 3) * 0.08 ?>s">
  <div class="card-media">
    <?= photo_img($p['cover'], '', '(max-width: 640px) 100vw, (max-width: 1024px) 50vw, 420px') ?>
    <span class="badge badge--<?= e($p['status']) ?>"><?= e(STATUSES[$p['status']]) ?></span>
    <span class="card-loc"><?= icon('map-pin') ?><?= e($p['location']) ?></span>
  </div>
  <div class="card-body">
    <?php if (!empty($p['chapter'])): ?>
      <p class="card-kicker"><?= e($p['chapter']) ?></p>
    <?php endif ?>
    <h3 class="card-title"><a href="<?= e(project_url($p)) ?>"><?= e($p['name']) ?></a></h3>
    <p class="card-text"><?= e($p['summary']) ?></p>
    <div class="card-foot">
      <span class="card-type"><?= icon('building') ?><?= e($p['config']) ?></span>
      <span class="card-go" aria-hidden="true"><?= icon('arrow-right') ?></span>
    </div>
  </div>
</article>
