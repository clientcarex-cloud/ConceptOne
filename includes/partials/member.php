<?php /** @var array $m  a TEAM entry  @var bool $bio  @var int $i */ ?>
<article class="member" data-reveal style="--d:<?= ($i ?? 0) * 0.1 ?>s">
  <div class="member-photo">
    <picture>
      <source type="image/webp" srcset="<?= asset('assets/img/team/' . $m['photo'] . '.webp') ?>">
      <img src="<?= asset('assets/img/team/' . $m['photo'] . '.jpg') ?>" alt="Portrait of <?= e($m['name']) ?>" width="640" height="800" loading="lazy" decoding="async">
    </picture>
    <p class="member-quote"><?= e($m['quote']) ?></p>
  </div>
  <div class="member-info">
    <h3 class="member-name"><?= e($m['name']) ?></h3>
    <p class="member-role"><?= e($m['role']) ?></p>
    <?php if (!empty($bio)): ?>
      <p class="member-bio"><?= e($m['bio']) ?></p>
    <?php endif ?>
  </div>
</article>
