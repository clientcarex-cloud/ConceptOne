<?php
/**
 * Site-wide settings. Every business detail is defined here exactly once —
 * change it here and it changes on every page.
 *
 * Lines marked TODO are placeholders. Confirm them before going live.
 */
declare(strict_types=1);

const SITE_NAME  = 'Concept One Developers';
const SITE_SHORT = 'Concept One';
const SITE_URL   = 'https://conceptonedevelopers.com';   // TODO: confirm the live domain
const CITY       = 'Hyderabad';

const PHONE      = '+91 90000 00000';                    // TODO: sales line as displayed
const PHONE_HREF = '+919000000000';                      // TODO: same number, digits only
const WHATSAPP   = '919000000000';                       // TODO: country code + number, digits only
const EMAIL      = 'sales@conceptonedevelopers.com';     // TODO
const ADDRESS    = ['Concept One Developers', 'Hyderabad, Telangana, India']; // TODO: street address
const HOURS      = 'Mon – Sat · 10:00 am – 7:00 pm';
const MAP_QUERY  = 'Hyderabad, Telangana';               // what the contact-page map centres on

/** Where enquiries are delivered. */
const MAIL_TO = EMAIL;

/** Year the company started — drives the "years of trust" figures. */
const FOUNDED = 2012;                                    // TODO

/**
 * No Cost EMI — offered directly by Concept One (no bank, no interest) on a
 * fixed share of the property price. The rest follows the payment schedule.
 */
const NO_COST_EMI_SHARE      = 30;                      // % of the price payable as interest-free EMIs
const NO_COST_EMI_MIN_MONTHS = 6;                       // TODO: confirm shortest tenure offered
const NO_COST_EMI_MAX_MONTHS = 36;                      // TODO: confirm longest tenure offered

/** Header navigation: key => [label, href]. Links are extensionless (see .htaccess). */
const NAV = [
    'home'     => ['Home', ''],
    'projects' => ['Projects', 'projects'],
    'about'    => ['About', 'about'],
    'contact'  => ['Contact', 'contact'],
];

/** Social profiles: [icon, label, url]. Links set to '#' are hidden. */
const SOCIAL = [
    ['instagram', 'Instagram', '#'],                     // TODO
    ['facebook', 'Facebook', '#'],                       // TODO
    ['linkedin', 'LinkedIn', '#'],                       // TODO
    ['youtube', 'YouTube', '#'],                         // TODO
];

/** Shown under every price. */
const PRICE_NOTE = 'Prices are indicative and exclusive of registration, GST and other statutory charges.';
