<?php
/** EMI calculator. @var int $price  starting property price in ₹ */
$price = (int) min(max($price ?? 12000000, 2000000), 100000000);
?>
<div class="emi-card" data-emi>
  <div>
    <div class="range">
      <div class="range-head"><label for="emi-price">Property price</label><output data-out="price" for="emi-price"></output></div>
      <input id="emi-price" type="range" name="price" min="2000000" max="100000000" step="100000" value="<?= $price ?>">
    </div>
    <div class="range">
      <div class="range-head"><label for="emi-down">Down payment</label><output data-out="down" for="emi-down"></output></div>
      <input id="emi-down" type="range" name="down" min="10" max="60" step="5" value="20">
    </div>
    <div class="range">
      <div class="range-head"><label for="emi-rate">Interest rate</label><output data-out="rate" for="emi-rate"></output></div>
      <input id="emi-rate" type="range" name="rate" min="6.5" max="12" step="0.05" value="8.5">
    </div>
    <div class="range">
      <div class="range-head"><label for="emi-years">Loan tenure</label><output data-out="years" for="emi-years"></output></div>
      <input id="emi-years" type="range" name="years" min="5" max="30" step="1" value="20">
    </div>
  </div>
  <div class="emi-result" aria-live="polite">
    <div class="emi-amount"><small>Your monthly EMI</small><strong data-out="emi">—</strong></div>
    <div class="donut" aria-hidden="true"></div>
    <ul class="legend">
      <li><span><i style="background:var(--amber)"></i>Loan amount</span><b data-out="loan">—</b></li>
      <li><span><i style="background:var(--plum)"></i>Total interest</span><b data-out="interest">—</b></li>
      <li><span>Total payable</span><b data-out="total">—</b></li>
    </ul>
  </div>
</div>
