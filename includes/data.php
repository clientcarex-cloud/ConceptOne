<?php
/**
 * Site content: projects, team, figures and copy blocks.
 *
 * Photography IDs refer to images on Unsplash's CDN (see photo() in
 * helpers.php). Swap them for your own project renders by changing the ID,
 * or point photo() at local files.
 *
 * SAMPLE content is marked. Replace it with real figures before launch.
 */
declare(strict_types=1);

/** Page-level photography. */
const PHOTOS = [
    'intro_main'    => '1600573472550-8090b5e0745e',
    'intro_small'   => '1600047509807-ba8f99d2cdde',
    'projects_hero' => '1545324418-cc1a3fa10c00',
    'about_hero'    => '1600585154526-990dced4db0d',
    'about_story'   => '1600566753190-17f0baa2a6c3',
    'contact_hero'  => '1600607687939-ce8a6c25118c',
    'notfound'      => '1494526585095-c41746248156',
    'spotlight'     => '1600596542815-ffad4c1539a9',
];

/** Home hero slides: [photo, project slug]. */
const HERO_SLIDES = [
    ['1600585154340-be6161a56a0c', 'aurum-villas'],
    ['1479839672679-a46483c0e7c8', 'skyline-residences'],
    ['1613490493576-7fde63acd811', 'palm-grove-estates'],
];

/** Headline figures. Project counts are confirmed; the rest are SAMPLE — confirm them. */
function stats(): array
{
    return [
        ['n' => years_active(), 'dec' => 0, 'suffix' => '+', 'label' => 'Years building in ' . CITY],
        ['n' => 11, 'dec' => 0, 'suffix' => '', 'label' => 'Delivered projects'],
        ['n' => 3, 'dec' => 0, 'suffix' => '', 'label' => 'Ongoing projects'],
        ['n' => 1800, 'dec' => 0, 'suffix' => '+', 'label' => 'Families moved in'],
    ];
}

const STATUSES = [
    'ongoing'   => 'Under construction',
    'upcoming'  => 'Launching soon',
    'completed' => 'Ready to move',
];

const TYPES = ['Apartments', 'Villas', 'Commercial'];

/** Budget bands for search: key => [label, min, max]. */
const BUDGETS = [
    'u1'  => ['Under ₹1 Cr', 0, 10000000],
    '1-2' => ['₹1 – 2 Cr', 10000000, 20000000],
    '2-4' => ['₹2 – 4 Cr', 20000000, 40000000],
    '4+'  => ['Above ₹4 Cr', 40000000, PHP_INT_MAX],
];

/** Shared amenity labels: icon => label. */
const AMENITY_SET = [
    'pool'     => 'Swimming pool',
    'gym'      => 'Fitness studio',
    'coffee'   => 'Clubhouse & café',
    'trees'    => 'Landscaped gardens',
    'smile'    => "Kids' play zone",
    'activity' => 'Jogging track',
    'camera'   => '24×7 CCTV',
    'zap'      => '100% power backup',
    'parking'  => 'Covered parking',
    'shield'   => 'Gated security',
    'droplets' => 'Rainwater harvesting',
    'sun'      => 'Solar common lighting',
    'users'    => 'Multipurpose hall',
    'briefcase'=> 'Business lounge',
];

/**
 * Projects. SAMPLE — names, figures and prices are placeholders.
 *   status  ongoing | upcoming | completed
 *   price   display string; price_value (₹) drives search and the EMI calculator
 *   rera    registration number, shown only when filled in
 */
const PROJECTS = [
    [
        'slug'        => 'skyline-residences',
        'name'        => 'Skyline Residences',
        'tagline'     => 'Sky-high living on the western skyline.',
        'status'      => 'ongoing',
        'type'        => 'Apartments',
        'location'    => 'Kokapet',
        'config'      => '3 & 4 BHK Apartments',
        'size'        => '1,950 – 3,400 sq.ft',
        'price'       => '₹1.85 Cr',
        'price_value' => 18500000,
        'possession'  => 'Dec 2027',
        'rera'        => '',
        'cover'       => '1479839672679-a46483c0e7c8',
        'gallery'     => ['1600607687939-ce8a6c25118c', '1522708323590-d24dbb6b0267', '1616594039964-ae9021a400a0', '1600566752355-35792bedcfea', '1617806118233-18e1de247200'],
        'summary'     => 'Three slender towers with only four homes per floor, every one a corner home with a wraparound deck.',
        'overview'    => [
            'Skyline Residences rises above Kokapet with three G+36 towers set around a two-acre landscaped podium. With just four homes on every floor, each residence is a corner home — cross-ventilated, flooded with daylight and framed by a wraparound deck.',
            'Ten-foot ceilings, a private foyer and a separate utility come as standard. On the podium, a 40,000 sq.ft clubhouse brings an infinity pool, a fitness studio, a co-working lounge and a residents-only café a lift ride away.',
        ],
        'highlights'  => ['Only 4 homes per floor', '10 ft floor-to-ceiling height', '2-acre landscaped podium', '40,000 sq.ft clubhouse', 'Wraparound sit-out decks', 'Minutes from the Financial District'],
        'specs'       => ['Land parcel' => '5.2 acres', 'Towers' => '3', 'Floors' => 'G + 36', 'Residences' => '432'],
        'plans'       => [['3 BHK', '1,950 sq.ft', '₹1.85 Cr'], ['3 BHK + Study', '2,380 sq.ft', '₹2.25 Cr'], ['4 BHK Sky Villa', '3,400 sq.ft', '₹3.30 Cr']],
        'amenities'   => ['pool', 'gym', 'coffee', 'trees', 'smile', 'activity', 'briefcase', 'camera', 'zap', 'parking'],
        'nearby'      => [['briefcase', 'Financial District', '8 min'], ['road', 'Outer Ring Road', '4 min'], ['school', 'International schools', '6 min'], ['hospital', 'Multi-speciality hospitals', '10 min'], ['shopping', 'Malls & high street', '12 min'], ['plane', 'RGI Airport', '30 min']],
        'progress'    => 48,
        'milestones'  => ['Excavation' => 'done', 'Foundation' => 'done', 'Superstructure' => 'now', 'Finishing' => 'next'],
    ],
    [
        'slug'        => 'aurum-villas',
        'name'        => 'Aurum Villas',
        'tagline'     => 'Private villas wrapped in green.',
        'status'      => 'ongoing',
        'type'        => 'Villas',
        'location'    => 'Tellapur',
        'config'      => '4 BHK Luxury Villas',
        'size'        => '4,200 – 5,600 sq.ft',
        'price'       => '₹4.75 Cr',
        'price_value' => 47500000,
        'possession'  => 'Jun 2027',
        'rera'        => '',
        'cover'       => '1600585154340-be6161a56a0c',
        'gallery'     => ['1600596542815-ffad4c1539a9', '1613977257363-707ba9348227', '1600573472550-8090b5e0745e', '1600210492486-724fe5c67fb0', '1512918728675-ed5a9ecdebfd'],
        'summary'     => 'Just 86 contemporary villas on a 22-acre gated estate, each with a private garden and a terrace deck.',
        'overview'    => [
            'Aurum Villas is a gated enclave of just 86 contemporary villas across 22 acres in Tellapur. Every villa sits on its own plot with a private garden, a double-height living room and a rooftop terrace made for long evenings.',
            'A tree-lined central boulevard leads to a resort-style clubhouse, and more than 60% of the estate is left open as parks, walking trails and water features.',
        ],
        'highlights'  => ['Only 86 villas on 22 acres', 'Private garden with every villa', 'Double-height living rooms', 'Rooftop terrace decks', '60% open green space', 'Home automation ready'],
        'specs'       => ['Land parcel' => '22 acres', 'Villas' => '86', 'Floors' => 'G + 2', 'Open space' => '60%'],
        'plans'       => [['4 BHK Villa', '4,200 sq.ft', '₹4.75 Cr'], ['4 BHK Villa Grande', '5,600 sq.ft', '₹6.20 Cr']],
        'amenities'   => ['pool', 'gym', 'coffee', 'trees', 'smile', 'activity', 'users', 'shield', 'droplets', 'sun'],
        'nearby'      => [['road', 'Outer Ring Road', '7 min'], ['briefcase', 'Gachibowli IT corridor', '18 min'], ['school', 'International schools', '5 min'], ['hospital', 'Hospitals', '12 min'], ['shopping', 'Shopping & dining', '10 min'], ['plane', 'RGI Airport', '40 min']],
        'progress'    => 62,
        'milestones'  => ['Site development' => 'done', 'Villa structures' => 'done', 'Clubhouse' => 'now', 'Landscaping' => 'next'],
    ],
    [
        'slug'        => 'the-crest',
        'name'        => 'The Crest',
        'tagline'     => 'Ready homes in the heart of Gachibowli.',
        'status'      => 'completed',
        'type'        => 'Apartments',
        'location'    => 'Gachibowli',
        'config'      => '2 & 3 BHK Apartments',
        'size'        => '1,280 – 1,860 sq.ft',
        'price'       => '₹1.10 Cr',
        'price_value' => 11000000,
        'possession'  => 'Ready to move',
        'rera'        => '',
        'cover'       => '1448630360428-65456885c650',
        'gallery'     => ['1502672260266-1c1ef2d93688', '1560448204-e02f11c3d0e2', '1600607687644-c7171b42498f', '1545324418-cc1a3fa10c00'],
        'summary'     => 'A completed, occupied community a short walk from the IT corridor. Move in this month.',
        'overview'    => [
            'The Crest is a completed community of 280 homes, a short walk from the Gachibowli IT corridor. Families have lived here since handover, and a limited number of ready homes are available for immediate registration.',
            'Efficient, Vastu-aligned plans with minimal wasted space sit alongside a fully operational clubhouse, a swimming pool and a landscaped central court.',
        ],
        'highlights'  => ['Ready to move in', 'Occupancy certificate received', 'Walk to the IT corridor', 'Vastu-aligned plans', 'Fully operational clubhouse', 'Active residents\' association'],
        'specs'       => ['Land parcel' => '3.1 acres', 'Towers' => '2', 'Floors' => 'G + 14', 'Homes' => '280'],
        'plans'       => [['2 BHK', '1,280 sq.ft', '₹1.10 Cr'], ['3 BHK', '1,620 sq.ft', '₹1.38 Cr'], ['3 BHK Large', '1,860 sq.ft', '₹1.58 Cr']],
        'amenities'   => ['pool', 'gym', 'coffee', 'trees', 'smile', 'camera', 'zap', 'parking'],
        'nearby'      => [['briefcase', 'IT corridor', '5 min'], ['train', 'Metro station', '10 min'], ['school', 'Schools', '6 min'], ['hospital', 'Hospitals', '8 min'], ['shopping', 'Malls', '7 min'], ['plane', 'RGI Airport', '35 min']],
        'progress'    => 100,
        'milestones'  => [],
    ],
    [
        'slug'        => 'one-meridian',
        'name'        => 'One Meridian',
        'tagline'     => 'Grade-A workspace for ambitious companies.',
        'status'      => 'upcoming',
        'type'        => 'Commercial',
        'location'    => 'Financial District',
        'config'      => 'Grade-A Office Spaces',
        'size'        => '1,500 – 25,000 sq.ft',
        'price'       => '₹1.60 Cr',
        'price_value' => 16000000,
        'possession'  => 'Launching 2027',
        'rera'        => '',
        'cover'       => '1486406146926-c627a92ad1ab',
        'gallery'     => ['1497366216548-37526070297c', '1600585154526-990dced4db0d', '1582407947304-fd86f028f716'],
        'summary'     => 'A LEED-targeted glass tower with flexible floor plates, built for both owner-occupiers and investors.',
        'overview'    => [
            'One Meridian is a Grade-A commercial tower planned for the Financial District, with efficient 25,000 sq.ft floor plates that divide into suites from 1,500 sq.ft.',
            'Designed for both owner-occupiers and investors, it pairs a double-height lobby and high-speed destination lifts with a rooftop business lounge. It is built to LEED Gold standards.',
        ],
        'highlights'  => ['Flexible suites from 1,500 sq.ft', 'LEED Gold targeted', 'Double-height grand lobby', 'Destination-control lifts', 'Rooftop business lounge', 'Assured-rental options for investors'],
        'specs'       => ['Land parcel' => '2.4 acres', 'Towers' => '1', 'Floors' => 'G + 24', 'Floor plate' => '25k sq.ft'],
        'plans'       => [['Office suite', '1,500 sq.ft', '₹1.60 Cr'], ['Half floor', '12,500 sq.ft', 'On request'], ['Full floor', '25,000 sq.ft', 'On request']],
        'amenities'   => ['briefcase', 'coffee', 'gym', 'camera', 'zap', 'parking', 'shield', 'sun'],
        'nearby'      => [['road', 'Outer Ring Road', '3 min'], ['train', 'Metro (proposed)', '5 min'], ['shopping', 'Hotels & dining', '5 min'], ['hospital', 'Hospitals', '10 min'], ['plane', 'RGI Airport', '28 min']],
        'progress'    => 0,
        'milestones'  => [],
    ],
    [
        'slug'        => 'serene-heights',
        'name'        => 'Serene Heights',
        'tagline'     => 'Calm, green and minutes from everything.',
        'status'      => 'completed',
        'type'        => 'Apartments',
        'location'    => 'Kondapur',
        'config'      => '2 & 3 BHK Apartments',
        'size'        => '1,150 – 1,720 sq.ft',
        'price'       => '₹92 L',
        'price_value' => 9200000,
        'possession'  => 'Ready to move',
        'rera'        => '',
        'cover'       => '1460317442991-0ec209397118',
        'gallery'     => ['1600210492486-724fe5c67fb0', '1600607687644-c7171b42498f', '1502672260266-1c1ef2d93688'],
        'summary'     => 'A mature, fully occupied community with generous balconies and a shaded central garden.',
        'overview'    => [
            'Serene Heights is a fully occupied community of 196 homes in Kondapur, built around a shaded central garden and a clubhouse the residents run themselves.',
            'Deep balconies, cross-ventilated plans and a quiet internal road make it a favourite with young families. Resale and rental support is available through our after-sales desk.',
        ],
        'highlights'  => ['Fully occupied community', 'Deep, usable balconies', 'Shaded central garden', 'Cross-ventilated plans', 'Resale & rental support', 'Close to schools and hospitals'],
        'specs'       => ['Land parcel' => '2.2 acres', 'Towers' => '2', 'Floors' => 'G + 10', 'Homes' => '196'],
        'plans'       => [['2 BHK', '1,150 sq.ft', '₹92 L'], ['3 BHK', '1,520 sq.ft', '₹1.22 Cr'], ['3 BHK Large', '1,720 sq.ft', '₹1.38 Cr']],
        'amenities'   => ['gym', 'coffee', 'trees', 'smile', 'camera', 'zap', 'parking', 'droplets'],
        'nearby'      => [['briefcase', 'HITEC City', '10 min'], ['train', 'Metro station', '8 min'], ['school', 'Schools', '4 min'], ['hospital', 'Hospitals', '6 min'], ['shopping', 'Shopping', '5 min']],
        'progress'    => 100,
        'milestones'  => [],
    ],
    [
        'slug'        => 'palm-grove-estates',
        'name'        => 'Palm Grove Estates',
        'tagline'     => 'Resort-style villas by the airport.',
        'status'      => 'upcoming',
        'type'        => 'Villas',
        'location'    => 'Shamshabad',
        'config'      => '3 & 4 BHK Villas',
        'size'        => '3,200 – 4,100 sq.ft',
        'price'       => '₹2.40 Cr',
        'price_value' => 24000000,
        'possession'  => 'Launching 2027',
        'rera'        => '',
        'cover'       => '1580587771525-78b9dba3b914',
        'gallery'     => ['1613490493576-7fde63acd811', '1512917774080-9991f1c4c750', '1523217582562-09d0def993a6', '1600563438938-a9a27216b4f5'],
        'summary'     => 'A palm-lined villa community fifteen minutes from the airport, with resort-grade amenities.',
        'overview'    => [
            'Palm Grove Estates brings resort-style living fifteen minutes from the international airport: 120 villas along palm-lined avenues, with a lagoon pool and a sports arena at its centre.',
            'Pre-launch registrations are open. Early buyers get first choice of plots and preferential pricing.',
        ],
        'highlights'  => ['120 villas on palm-lined avenues', 'Lagoon-style pool', 'Sports arena & courts', '15 min to the airport', 'Pre-launch pricing', 'First choice of plots'],
        'specs'       => ['Land parcel' => '28 acres', 'Villas' => '120', 'Floors' => 'G + 1', 'Open space' => '55%'],
        'plans'       => [['3 BHK Villa', '3,200 sq.ft', '₹2.40 Cr'], ['4 BHK Villa', '4,100 sq.ft', '₹3.05 Cr']],
        'amenities'   => ['pool', 'gym', 'coffee', 'trees', 'smile', 'activity', 'users', 'shield', 'sun', 'droplets'],
        'nearby'      => [['plane', 'RGI Airport', '15 min'], ['road', 'Outer Ring Road', '6 min'], ['school', 'Schools', '8 min'], ['hospital', 'Hospitals', '12 min'], ['shopping', 'Airport retail hub', '15 min']],
        'progress'    => 0,
        'milestones'  => [],
    ],
];

/** Construction specification, shared across residential projects. */
const SPECIFICATIONS = [
    'Structure'         => 'RCC framed structure designed to seismic codes, with solid concrete block masonry.',
    'Flooring'          => 'Large-format 800×1600 mm vitrified tiles in living and dining, wooden-finish tiles in bedrooms, and anti-skid tiles in balconies and bathrooms.',
    'Kitchen'           => 'Granite counter with stainless-steel sink, provision for water purifier, chimney and dishwasher.',
    'Doors & windows'   => 'Teak-wood main door frame with designer shutter; UPVC windows with toughened glass and mosquito mesh.',
    'Bathrooms'         => 'Premium sanitaryware and CP fittings, wall-hung WCs, and hot and cold mixer units.',
    'Electrical'        => 'Concealed fire-retardant copper wiring, modular switches, and provision for AC in all rooms and for home automation.',
];

/** Why-us pillars: [icon, title, text]. */
const FEATURES = [
    ['shield', 'Clear titles, approved plans', 'Legally vetted land, sanctioned plans and every approval on file. Inspect the paperwork before you pay a rupee.'],
    ['clock', 'Handovers on schedule', 'Construction milestones are published up front, and buyers get photo progress reports every month.'],
    ['gem', 'Specifications that last', 'Branded fittings, generous ceiling heights and materials chosen to age gracefully, not just photograph well.'],
    ['file', 'One honest cost sheet', 'An all-inclusive price breakdown at booking. No surprise charges at registration.'],
    ['compass', 'Plans that breathe', 'Vastu-aligned, cross-ventilated layouts with little wasted space and plenty of natural light in every room.'],
    ['key', 'Care after the keys', 'One relationship manager from booking to handover, and a dedicated after-sales desk after that.'],
];

/** Buying journey: [title, text]. */
const STEPS = [
    ['Discover', 'Tell us how you live, what you need and your budget. We shortlist the homes that fit.'],
    ['Visit', 'Tour the site and a show apartment. Weekend slots are available, with pick-up on request.'],
    ['Choose', 'Compare floors, facings and views side by side, with the full cost sheet in front of you.'],
    ['Pay easy', 'Spread ' . NO_COST_EMI_SHARE . '% of the price over No Cost EMIs, paid directly to us with zero interest.'],
    ['Move in', 'A guided handover with a snag-list walkthrough, and after-sales support once you settle in.'],
];

/** Leadership. TODO: confirm roles and bios. `photo` is the file stem in assets/img/team. */
const TEAM = [
    [
        'name'  => 'Mohammed',
        'role'  => 'Founder & Managing Director',
        'photo' => 'mohammed',
        'quote' => 'Every building carries our name. That is a promise we take personally.',
        'bio'   => 'Mohammed founded Concept One on a simple idea: build every home as if your own family were moving in. He leads strategy, land acquisition and the company\'s long-term vision.',
    ],
    [
        'name'  => 'Abdullah',
        'role'  => 'Director — Projects & Construction',
        'photo' => 'abdullah',
        'quote' => 'Quality is decided on site, every single day — not in the brochure.',
        'bio'   => 'Abdullah oversees design coordination, engineering and delivery on every site. Quality audits, schedules and contractor partnerships run through his team.',
    ],
    [
        'name'  => 'Sana Salauddin',
        'role'  => 'Director — Sales & Client Relations',
        'photo' => 'sana-salauddin',
        'quote' => 'A home is the biggest decision a family makes. They deserve clear answers.',
        'bio'   => 'Sana leads sales, marketing and customer experience. Her team walks every buyer through the process, from the first site visit through registration and handover.',
    ],
];

/** SAMPLE testimonials — replace with real client feedback before launch. */
const TESTIMONIALS = [
    ['We visited a dozen projects before The Crest. Concept One was the only builder who handed us the full cost sheet on day one — and handed over the keys on the date they promised.', 'Arjun & Meera R.', 'Homeowners, The Crest'],
    ['The monthly construction updates meant we never had to chase anyone. As NRIs, that transparency was everything.', 'Farhan S.', 'Buyer, Skyline Residences'],
    ['Deep balconies, cross ventilation, a proper utility area — you can tell the plans were drawn by people who actually live in this city.', 'Lakshmi N.', 'Homeowner, Serene Heights'],
    ['From the paperwork to the snag list at handover, Sana\'s team was on call the whole way. It never felt like a sales transaction.', 'Karthik V.', 'Homeowner, The Crest'],
];

/** About: values [title, text]. */
const VALUES = [
    ['Integrity', 'We commit only to what we can deliver, and we put it in writing.'],
    ['Craft', 'We sweat the details most buyers only notice years later.'],
    ['Transparency', 'Open cost sheets, open sites and open answers.'],
    ['Community', 'We plan neighbourhoods, not just floor plans.'],
];

/** About: milestones [year, title, text]. SAMPLE. */
const TIMELINE = [
    [FOUNDED, 'The first foundation stone', 'Concept One Developers is founded in Hyderabad with a single residential project and a team of twelve.'],
    [2016, 'Serene Heights delivered', 'Our first community is handed over ahead of schedule, and 196 families move in.'],
    [2020, 'The Crest completed', 'Delivered through the pandemic, with occupancy certificate in hand.'],
    [2023, 'Into luxury villas', 'Aurum Villas launches in Tellapur, and its first phase is fully booked in weeks.'],
    [2025, 'Skyline & One Meridian', 'Our tallest residential towers and our first Grade-A commercial address are announced.'],
];

/** Contact: FAQs [question, answer]. */
const FAQS = [
    ['Are your projects RERA registered?', 'Yes. The registration number for each project is shown on its project page and printed on every brochure and agreement. Ask our team for a copy of any approval.'],
    ['How does No Cost EMI work?', 'You pay ' . NO_COST_EMI_SHARE . '% of the property price in equal monthly instalments directly to ' . SITE_SHORT . ', with zero interest and no bank involved. The balance ' . (100 - NO_COST_EMI_SHARE) . '% is paid as per the project\'s payment schedule. Our team will share the exact tenure and terms for your chosen home.'],
    ['Can I visit a site on the weekend?', 'Yes. Site offices and show apartments are open all week. Book a slot and we can arrange pick-up and drop within the city.'],
    ['What payment plans are available?', 'Most projects follow a construction-linked plan. Selected projects also offer flexible and down-payment plans with preferential pricing.'],
    ['Do you assist NRI buyers?', 'Yes. We offer video walkthroughs, digital documentation and power-of-attorney guidance, so you can buy with confidence from anywhere.'],
];

/** Enquiry "interested in" options: projects plus general topics. */
function interest_options(): array
{
    $opts = array_map(fn ($p) => $p['name'] . ' — ' . $p['location'], PROJECTS);

    return array_merge($opts, ['General enquiry', 'Site visit', 'Channel partner', 'Land owner / joint development']);
}

/** Distinct project locations, in listing order. */
function locations(): array
{
    return array_values(array_unique(array_column(PROJECTS, 'location')));
}
