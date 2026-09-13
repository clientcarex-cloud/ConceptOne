<?php
/**
 * Headline figures.
 * @var string[] $keys  STATS keys to show, in order
 */
?>
<div class="stats stats--<?= count($keys) ?>">
  <?php foreach ($keys as $i => $key): $s = STATS[$key]; ?>
    <div class="stat" data-reveal style="--d:<?= ($i % 3) * 0.08 ?>s">
      <p class="stat-num"><span<?= ($s['count'] ?? true) ? ' data-count="' . $s['n'] . '"' : '' ?>><?= $s['n'] ?></span><?php if ($s['suffix'] !== ''): ?><sup><?= e($s['suffix']) ?></sup><?php endif ?></p>
      <p class="stat-label"><?= e($s['label']) ?></p>
    </div>
  <?php endforeach ?>
</div>
