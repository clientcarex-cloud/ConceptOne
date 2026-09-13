<?php /** The One Concept in practice: four ways ConceptOne makes ownership easier. */ ?>
<div class="offerings">
  <?php foreach (OFFERINGS as $i => [$ic, $title, $text]): ?>
    <article class="offering" data-reveal style="--d:<?= $i * 0.08 ?>s">
      <span class="offering-icon"><?= icon($ic) ?></span>
      <h3><?= e($title) ?></h3>
      <p><?= e($text) ?></p>
    </article>
  <?php endforeach ?>
</div>
