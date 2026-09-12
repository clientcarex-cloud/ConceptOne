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

/** Sales lines. PHONE is the primary one shown wherever there is room for only one. */
const PHONE          = '+91 97018 15185';
const PHONE_HREF     = '+919701815185';
const PHONE_ALT      = '+91 90307 43030';
const PHONE_ALT_HREF = '+919030743030';

const WHATSAPP   = '919701815185';                       // country code + number, digits only
const EMAIL      = 'sales@conceptonedevelopers.com';     // TODO
const ADDRESS    = [
    'Plot No. 8-1-400/60 & 61, 2nd Floor',
    'Westfield Center, above Dominos Pizza',
    'Deluxe Colony, Janaki Nagar Colony',
    'Toli Chowki, Hyderabad, Telangana 500008',
];
const HOURS      = 'All days · 12:00 pm – 8:00 pm';
const MAP_QUERY  = 'Westfield Center, Toli Chowki, Hyderabad, Telangana 500008'; // what the contact-page map centres on

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
    'about'    => ['About Us', 'about'],
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
