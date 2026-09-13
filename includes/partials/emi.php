<?php
/**
 * No Cost EMI calculator. Concept One carries NO_COST_EMI_SHARE % of the price
 * as interest-free monthly instalments; the balance follows the payment schedule.
 * @var int $price  starting property price in ₹
 */
$price   = (int) min(max($price ?? 6000000, 2000000), 30000000);
$months  = (int) min(NO_COST_EMI_MAX_MONTHS, max(NO_COST_EMI_MIN_MONTHS, 24));
$balance = 100 - NO_COST_EMI_SHARE;
?>
<div class="emi-card" data-emi data-share="<?= NO_COST_EMI_SHARE ?>">
  <div>
    <div class="range">
      <div class="range-head"><label for="emi-price">Property price</label><output data-out="price" for="emi-price"></output></div>
      <input id="emi-price" type="range" name="price" min="2000000" max="30000000" step="100000" value="<?= $price ?>">
    </div>
    <div class="range">
      <div class="range-head"><label for="emi-months">EMI tenure</label><output data-out="months" for="emi-months"></output></div>
      <input id="emi-months" type="range" name="months" min="<?= NO_COST_EMI_MIN_MONTHS ?>" max="<?= NO_COST_EMI_MAX_MONTHS ?>" step="1" value="<?= $months ?>">
    </div>
    <ul class="emi-facts">
      <li><?= icon('percent') ?><span><strong>0% interest.</strong> Your EMIs add nothing to the price.</span></li>
      <li><?= icon('handshake') ?><span><strong>Directly from <?= e(SITE_SHORT) ?>.</strong> No bank loan needed.</span></li>
      <li><?= icon('layers') ?><span><strong>Covers <?= NO_COST_EMI_SHARE ?>% of the price.</strong> The rest follows the payment schedule.</span></li>
    </ul>
  </div>
  <div class="emi-result" aria-live="polite">
    <div class="emi-amount"><small>Your monthly No Cost EMI</small><strong data-out="emi">—</strong><span data-out="term"></span></div>
    <div class="donut" aria-hidden="true"></div>
    <ul class="legend">
      <li><span><i style="background:var(--amber)"></i><?= NO_COST_EMI_SHARE ?>% on EMI</span><b data-out="share">—</b></li>
      <li><span><i style="background:var(--plum)"></i>Balance <?= $balance ?>%</span><b data-out="balance">—</b></li>
      <li><span>Interest you pay</span><b>₹0</b></li>
    </ul>
  </div>
</div>
<p class="emi-note">No Cost EMI is offered directly by <?= e(SITE_NAME) ?> on <?= NO_COST_EMI_SHARE ?>% of the property price, with zero interest. The balance <?= $balance ?>% is payable as per the project's payment schedule. Terms &amp; conditions apply.</p>
