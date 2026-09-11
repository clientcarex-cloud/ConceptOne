<?php
require_once __DIR__ . '/includes/bootstrap.php';

if (!headers_sent()) {
    http_response_code(404);
}

$page = [
    'nav'         => '',
    'path'        => '404.php',
    'title'       => 'Page not found | ' . SITE_NAME,
    'description' => "The page you were looking for doesn't exist.",
    'noindex'     => true,
];
require ROOT . '/includes/header.php';
?>

<section class="notfound on-dark">
  <?= photo_img(PHOTOS['notfound'], '', '100vw', ['loading' => 'eager']) ?>
  <div class="inner">
    <p class="big" aria-hidden="true">404</p>
    <h1>This address <em>isn't built yet.</em></h1>
    <p class="lead">The page you're looking for has moved or never existed. Let's find you somewhere better to be.</p>
    <div class="btn-row">
      <a class="btn btn--light" href="<?= url() ?>">Back to home <?= icon('arrow-right') ?></a>
      <a class="btn btn--ghost" href="<?= e(url('projects.php')) ?>">Browse projects</a>
    </div>
  </div>
</section>

<?php require ROOT . '/includes/footer.php'; ?>
