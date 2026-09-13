<?php
/**
 * A founder or leadership member: a card on the home page, the full
 * biography when $full is set.
 * @var array $f  a FOUNDERS or LEADERSHIP entry  @var int $i  @var bool $full
 */
$full ??= false;
?>
<article class="founder<?= $full ? ' founder--full' : '' ?>" data-reveal style="--d:<?= ($i ?? 0) * 0.12 ?>s">
  <div class="founder-photo"><?= founder_img($f) ?></div>
  <div class="founder-body">
    <p class="founder-role"><?= e($f['role']) ?></p>
    <h3 class="founder-name"><?= e($f['name']) ?></h3>
    <?php if ($f['credential'] !== ''): ?>
      <p class="founder-cred"><?= icon('school') ?><?= e($f['credential']) ?></p>
    <?php endif ?>
    <?php if ($full): ?>
      <div class="prose prose--lead">
        <?php foreach ($f['bio'] as $para): ?><p><?= e($para) ?></p><?php endforeach ?>
      </div>
      <?php if ($f['quote'] !== ''): ?>
        <blockquote class="founder-quote"><?= e($f['quote']) ?></blockquote>
      <?php endif ?>
    <?php else: ?>
      <p class="founder-intro"><?= e($f['intro']) ?></p>
    <?php endif ?>
  </div>
</article>
