<?php
/** @var array $p  a PROJECTS entry  @var int $i  position, for the reveal stagger */
$search = mb_strtolower(implode(' ', [$p['name'], $p['location'], $p['type'], $p['config']]));
?>
<article class="card" data-status="<?= e($p['status']) ?>" data-type="<?= e($p['type']) ?>" data-loc="<?= e($p['location']) ?>" data-price="<?= (int) $p['price_value'] ?>" data-search="<?= e($search) ?>" data-reveal style="--d:<?= (($i ?? 0) % 3) * 0.08 ?>s">
  <div class="card-media">
    <?= photo_img($p['cover'], $p['name'] . ', ' . $p['location'], '(max-width: 640px) 100vw, (max-width: 1024px) 50vw, 420px') ?>
    <span class="badge badge--<?= e($p['status']) ?>"><?= e(STATUSES[$p['status']]) ?></span>
    <span class="card-loc"><?= icon('map-pin') ?><?= e($p['location']) ?></span>
  </div>
  <div class="card-body">
    <h3 class="card-title"><a href="<?= e(project_url($p)) ?>"><?= e($p['name']) ?></a></h3>
    <p class="card-type"><?= e($p['config']) ?></p>
    <div class="card-specs">
      <span><?= icon('area') ?><?= e($p['size']) ?></span>
      <span><?= icon('key') ?><?= e($p['possession']) ?></span>
    </div>
    <div class="card-foot">
      <div class="price"><small>Starting from</small><strong><?= e($p['price']) ?></strong></div>
      <span class="card-go" aria-hidden="true"><?= icon('arrow-right') ?></span>
    </div>
  </div>
</article>
