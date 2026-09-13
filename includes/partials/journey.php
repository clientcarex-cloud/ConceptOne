<?php /** Our Journey timeline: horizontal on wide screens, vertical on narrow ones. */ ?>
<ol class="journey" data-reveal>
  <?php foreach (JOURNEY as $i => [$when, $title, $text]): ?>
    <li class="journey-step" style="--d:<?= 0.15 + $i * 0.12 ?>s">
      <span class="journey-when"><?= e($when) ?></span>
      <span class="journey-dot" aria-hidden="true"></span>
      <h3><?= e($title) ?></h3>
      <p><?= e($text) ?></p>
    </li>
  <?php endforeach ?>
</ol>
