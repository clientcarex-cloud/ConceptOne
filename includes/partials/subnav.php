<?php
/**
 * Sticky in-page navigation; main.js highlights the section in view.
 * @var array<string,string> $sections  id => label
 * @var string $label  accessible name
 */
?>
<nav class="subnav" aria-label="<?= e($label) ?>">
  <div class="container">
    <ul>
      <?php foreach ($sections as $id => $text): ?>
        <li><a href="#<?= e($id) ?>"><?= e($text) ?></a></li>
      <?php endforeach ?>
    </ul>
  </div>
</nav>
