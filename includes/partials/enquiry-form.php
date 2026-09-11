<?php
/**
 * Enquiry form. Always posts to contact.php, which validates, logs and mails it.
 *
 * @var array  $form     errors/values from a failed submission (optional)
 * @var bool   $compact  short version for project sidebars (optional)
 * @var string $project  interest to pre-fill (optional)
 * @var string $source   where the enquiry came from, for the log (optional)
 */
$form    ??= [];
$compact ??= false;
$v   = $form['values'] ?? [];
$err = $form['errors'] ?? [];
$id  = $compact ? 'q-' : 'f-';

$val  = fn (string $k): string => e($v[$k] ?? '');
$cls  = fn (string $k, string $extra = ''): string => trim("field $extra" . (isset($err[$k]) ? ' has-error' : ''));
$msg  = fn (string $k): string => isset($err[$k]) ? '<p class="field-error" id="' . $id . 'err-' . $k . '">' . e($err[$k]) . '</p>' : '';
$aria = fn (string $k): string => isset($err[$k]) ? ' aria-invalid="true" aria-describedby="' . $id . 'err-' . $k . '"' : '';

$interest = $v['interest'] ?? ($project ?? (string) ($_GET['interest'] ?? ''));
?>
<form class="form" method="post" action="<?= e(url('contact')) ?>#enquire" novalidate>
  <input type="hidden" name="token" value="<?= e(csrf_token()) ?>">
  <input type="hidden" name="source" value="<?= e($source ?? 'contact') ?>">
  <div class="hp" aria-hidden="true"><label>Leave this empty <input type="text" name="website" tabindex="-1" autocomplete="off"></label></div>

  <?php if (isset($err['form'])): ?>
    <div class="notice notice--err field--full" role="alert"><?= icon('x') ?><span><?= e($err['form']) ?></span></div>
  <?php endif ?>

  <div class="<?= $cls('name', $compact ? 'field--full' : '') ?>">
    <label for="<?= $id ?>name">Full name <span class="req">*</span></label>
    <input id="<?= $id ?>name" name="name" type="text" autocomplete="name" required maxlength="120" placeholder="Your name" value="<?= $val('name') ?>"<?= $aria('name') ?>>
    <?= $msg('name') ?>
  </div>

  <div class="<?= $cls('phone', $compact ? 'field--full' : '') ?>">
    <label for="<?= $id ?>phone">Phone <span class="req">*</span></label>
    <input id="<?= $id ?>phone" name="phone" type="tel" inputmode="tel" autocomplete="tel" required maxlength="20" placeholder="+91 98765 43210" value="<?= $val('phone') ?>"<?= $aria('phone') ?>>
    <?= $msg('phone') ?>
  </div>

  <?php if ($compact): ?>
    <input type="hidden" name="interest" value="<?= e($interest) ?>">
  <?php else: ?>
    <div class="<?= $cls('email') ?>">
      <label for="<?= $id ?>email">Email</label>
      <input id="<?= $id ?>email" name="email" type="email" autocomplete="email" maxlength="160" placeholder="you@example.com" value="<?= $val('email') ?>"<?= $aria('email') ?>>
      <?= $msg('email') ?>
    </div>

    <div class="field">
      <label for="<?= $id ?>interest">Interested in</label>
      <select id="<?= $id ?>interest" name="interest">
        <option value="">Select a project or topic</option>
        <?php foreach (interest_options() as $opt): ?>
          <option<?= $opt === $interest ? ' selected' : '' ?>><?= e($opt) ?></option>
        <?php endforeach ?>
      </select>
    </div>

    <div class="field">
      <label for="<?= $id ?>budget">Budget</label>
      <select id="<?= $id ?>budget" name="budget">
        <option value="">Select a range</option>
        <?php foreach ([...array_column(BUDGETS, 0), 'Not decided yet'] as $opt): ?>
          <option<?= $opt === ($v['budget'] ?? '') ? ' selected' : '' ?>><?= e($opt) ?></option>
        <?php endforeach ?>
      </select>
    </div>

    <div class="<?= $cls('visit_date') ?>">
      <label for="<?= $id ?>visit">Preferred visit date</label>
      <input id="<?= $id ?>visit" name="visit_date" type="date" min="<?= date('Y-m-d') ?>" value="<?= $val('visit_date') ?>"<?= $aria('visit_date') ?>>
      <?= $msg('visit_date') ?>
    </div>

    <div class="<?= $cls('message', 'field--full') ?>">
      <label for="<?= $id ?>message">Message</label>
      <textarea id="<?= $id ?>message" name="message" maxlength="3000" placeholder="Tell us what you're looking for — size, floor, facing, timelines…"<?= $aria('message') ?>><?= $val('message') ?></textarea>
      <?= $msg('message') ?>
    </div>
  <?php endif ?>

  <div class="<?= $cls('consent', 'field--full') ?>">
    <label class="consent">
      <input type="checkbox" name="consent" value="1" required<?= ($v['consent'] ?? '') === '1' ? ' checked' : '' ?><?= $aria('consent') ?>>
      <span>I agree to be contacted by <?= e(SITE_SHORT) ?> by call, SMS, WhatsApp or email about my enquiry.</span>
    </label>
    <?= $msg('consent') ?>
  </div>

  <div class="field--full">
    <button class="btn btn--grad btn--block" type="submit"><?= $compact ? 'Request a call back' : 'Send enquiry' ?> <?= icon('arrow-right') ?></button>
  </div>
</form>
