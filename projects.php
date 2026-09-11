<?php
require_once __DIR__ . '/includes/bootstrap.php';

$page = [
    'nav'         => 'projects',
    'path'        => 'projects',
    'title'       => 'Projects — Apartments, Villas & Commercial Spaces in ' . CITY . ' | ' . SITE_NAME,
    'description' => 'Browse ongoing, upcoming and ready-to-move projects by ' . SITE_NAME . '. Filter by location, property type and budget.',
    'image'       => PHOTOS['projects_hero'],
];

// Pre-select filters from the query string (the home search posts here).
$get = fn (string $k): string => trim((string) ($_GET[$k] ?? ''));
$sel = ['q' => $get('q'), 'type' => $get('type'), 'loc' => $get('loc'), 'budget' => $get('budget'), 'status' => $get('status')];
if (!isset(STATUSES[$sel['status']])) {
    $sel['status'] = '';
}

require ROOT . '/includes/header.php';
?>

<section class="page-hero page-hero--short on-dark">
  <?= photo_img(PHOTOS['projects_hero'], '', '100vw', ['loading' => 'eager', 'fetchpriority' => 'high']) ?>
  <div class="container">
    <ol class="crumbs">
      <li><a href="<?= url() ?>">Home</a></li>
      <li aria-current="page">Projects</li>
    </ol>
    <h1>Find your next <em>address.</em></h1>
    <p class="lead"><?= count(PROJECTS) ?> projects across <?= count(locations()) ?> of <?= CITY ?>'s most sought-after neighbourhoods, from ready-to-move apartments to villas launching soon.</p>
  </div>
</section>

<div class="filters">
  <div class="container">
    <form data-project-filters role="search" aria-label="Filter projects">
      <div class="search-input">
        <?= icon('search') ?>
        <label class="sr-only" for="f-q">Search projects</label>
        <input id="f-q" type="search" name="q" placeholder="Search by name or location" value="<?= e($sel['q']) ?>">
      </div>

      <div class="tabs" role="group" aria-label="Project status">
        <button class="tab" type="button" data-status="" aria-pressed="<?= $sel['status'] === '' ? 'true' : 'false' ?>">All</button>
        <?php foreach (['ongoing' => 'Ongoing', 'upcoming' => 'Upcoming', 'completed' => 'Completed'] as $k => $label): ?>
          <button class="tab" type="button" data-status="<?= $k ?>" aria-pressed="<?= $sel['status'] === $k ? 'true' : 'false' ?>"><?= $label ?></button>
        <?php endforeach ?>
      </div>

      <label class="sr-only" for="f-type">Property type</label>
      <select class="pill-select" id="f-type" name="type">
        <option value="">All types</option>
        <?php foreach (TYPES as $t): ?><option<?= $sel['type'] === $t ? ' selected' : '' ?>><?= e($t) ?></option><?php endforeach ?>
      </select>

      <label class="sr-only" for="f-loc">Location</label>
      <select class="pill-select" id="f-loc" name="loc">
        <option value="">All locations</option>
        <?php foreach (locations() as $loc): ?><option<?= $sel['loc'] === $loc ? ' selected' : '' ?>><?= e($loc) ?></option><?php endforeach ?>
      </select>

      <label class="sr-only" for="f-budget">Budget</label>
      <select class="pill-select" id="f-budget" name="budget">
        <option value="">Any budget</option>
        <?php foreach (BUDGETS as $k => [$label]): ?><option value="<?= e($k) ?>"<?= $sel['budget'] === $k ? ' selected' : '' ?>><?= e($label) ?></option><?php endforeach ?>
      </select>
    </form>
  </div>
</div>

<section class="section section--tight">
  <div class="container">
    <div class="results-bar">
      <p>Showing <strong data-result-count><?= count(PROJECTS) ?> projects</strong></p>
      <button class="link-arrow" type="button" data-reset>Clear filters</button>
    </div>

    <div class="grid-projects" id="project-grid">
      <?php foreach (PROJECTS as $i => $p) part('project-card', ['p' => $p, 'i' => $i]) ?>
    </div>

    <div class="empty" data-empty hidden>
      <h2 class="h3">No projects match those filters.</h2>
      <p>Try another location or budget, or ask our team about upcoming launches.</p>
      <div class="btn-row" style="justify-content:center">
        <button class="btn btn--dark" type="button" data-reset>Clear filters</button>
        <a class="btn btn--outline" href="<?= e(url('contact')) ?>#enquire">Talk to our team</a>
      </div>
    </div>
  </div>
</section>

<?php part('cta') ?>

<?php require ROOT . '/includes/footer.php'; ?>
