<?php
/**
 * Site content: projects, founders, journey, figures and the shorter copy
 * blocks shared between pages. Long-form narrative lives in the page templates.
 *
 * Copy follows the client's brief (September 2026).
 *
 * Photography IDs refer to images on Unsplash's CDN (see photo() in
 * helpers.php). They are REPRESENTATIVE stand-ins until real project photos
 * arrive — swap an ID, or point photo() at local files.
 */
declare(strict_types=1);

/** Page-level photography. */
const PHOTOS = [
    'hero'          => '1597047084897-51e81819a499',
    'hyderabad'     => '1551161242-b5af797b7233',   // Charminar
    'home_interior' => '1600210492486-724fe5c67fb0',
    'construction'  => '1541888946425-d81bb19240f5',
    'keys'          => '1560518883-ce09059eeffa',
    'community'     => '1511895426328-dc8714191300',
    'projects_hero' => '1574362848149-11496d93a7c7',
    'contact_hero'  => '1567767292278-a4f21aa2d36e',
    'notfound'      => '1494526585095-c41746248156',
];

/**
 * Headline figures. `count` => false keeps a value (like a year) from
 * animating, since "1,204" mid-count reads wrong.
 */
const STATS = [
    'years'     => ['n' => 6, 'suffix' => '+', 'label' => 'Years of development experience in ' . CITY],
    'delivered' => ['n' => 11, 'suffix' => '', 'label' => 'Projects delivered'],
    'ongoing'   => ['n' => 4, 'suffix' => '', 'label' => 'Projects currently under development'],
    'since'     => ['n' => FOUNDED, 'suffix' => '', 'label' => 'The year our development journey began', 'count' => false],
    'founder'   => ['n' => 12, 'suffix' => '+', 'label' => "Years of our founder's real-estate experience"],
    'families'  => ['n' => 100, 'suffix' => 's', 'label' => 'Of families & customers served'],
];

const STATUSES = [
    'delivered' => 'Delivered',
    'ongoing'   => 'Under development',
];

/**
 * Delivered projects, in the order they are shown. The four ongoing projects
 * are counted in STATS and shown as "launching soon" until they are named.
 *   location  as it should read on the page; also drives the map
 *   chapter   short label for the two founding projects
 *   facts     label => value fact sheet (optional)
 *   units     apartment sizes (optional)
 *   story     project-page paragraphs (optional; summary is used otherwise)
 */
const PROJECTS = [
    [
        'slug'     => 'diamond-avenue',
        'name'     => 'Diamond Avenue',
        'location' => 'Puppalaguda',
        'status'   => 'delivered',
        'chapter'  => 'Project 01 · Our first project',
        'config'   => '10 Premium 3BHK Apartments',
        'summary'  => 'Our very first project, delivered through one of the most challenging periods the country has experienced.',
        'cover'    => '1597047084897-51e81819a499',
        'facts'    => [
            'Building' => 'Ground + 5 floors',
            'Homes'    => '10 premium 3BHK apartments',
            'Layout'   => '2 spacious apartments on each floor',
            'Size'     => 'Approx. 1,375 sq.ft per apartment',
            'Parking'  => '10 dedicated car parking spaces',
        ],
        'units'    => [],
        'story'    => [
            'Diamond Avenue was the first project the brothers signed, under the name SmartCity Developers. Soon after, the country went into lockdown: construction was disrupted, movement was restricted and businesses were shutting down.',
            'The commitment remained. The project was completed and delivered to its customers during one of the most challenging periods the country had experienced.',
            'For ConceptOne, Diamond Avenue was more than a project. It was proof that determination can overcome circumstances, and the first major milestone in a journey that has gone on to create many more homes across Hyderabad.',
        ],
    ],
    [
        'slug'     => 'smartcity-avenue',
        'name'     => 'SmartCity Avenue',
        'location' => 'Padma Shree Colony, Sun City',
        'status'   => 'delivered',
        'chapter'  => 'Project 02',
        'config'   => '15 Premium 2BHK Apartments',
        'summary'  => 'Fifteen homes that proved affordable living spaces need not compromise on planning or quality.',
        'cover'    => '1515263487990-61b07816b324',
        'facts'    => [
            'Building' => 'Ground + 5 floors',
            'Homes'    => '15 premium 2BHK apartments',
            'Layout'   => '3 apartments on each floor',
            'Parking'  => '15 dedicated car parking spaces',
        ],
        'units'    => ['1,015 sq.ft', '1,115 sq.ft', '1,200 sq.ft'],
        'story'    => [
            'Following the successful delivery of Diamond Avenue, the team continued its journey with its second project at Padma Shree Colony, Sun City.',
            'SmartCity Avenue brought 15 apartments in multiple configurations, three on each floor, each with its own dedicated car parking space.',
            'Its successful completion strengthened the team\'s belief that affordable living spaces could be created without compromising on thoughtful planning and quality.',
        ],
    ],
    [
        'slug'     => 'kohinoor-20',
        'name'     => 'Kohinoor 20',
        'location' => 'Alkapur, Kohinoor Colony',
        'status'   => 'delivered',
        'config'   => 'Residential development',
        'summary'  => 'A residential development designed around modern urban living and practical family spaces.',
        'cover'    => '1574362848149-11496d93a7c7',
    ],
    [
        'slug'     => 'le-crown',
        'name'     => 'Le Crown',
        'location' => 'Attapur',
        'status'   => 'delivered',
        'config'   => 'Residential development',
        'summary'  => 'A thoughtfully developed residential project focused on comfortable city living.',
        'cover'    => '1545324418-cc1a3fa10c00',
    ],
    [
        'slug'     => 'casa',
        'name'     => 'Casa',
        'location' => 'Sabza Colony',
        'status'   => 'delivered',
        'config'   => 'Residential development',
        'summary'  => 'A contemporary residential development created with affordability and functionality in mind.',
        'cover'    => '1460317442991-0ec209397118',
    ],
    [
        'slug'     => 'anita',
        'name'     => 'Anita',
        'location' => 'Jubilee Hills – Filmnagar',
        'status'   => 'delivered',
        'config'   => 'Premium residential development',
        'summary'  => "A premium residential development positioned in one of Hyderabad's sought-after locations.",
        'cover'    => '1600585154526-990dced4db0d',
    ],
    [
        'slug'     => 'nest',
        'name'     => 'Nest',
        'location' => 'Sun City',
        'status'   => 'delivered',
        'config'   => 'Residential development',
        'summary'  => 'A carefully planned residential project designed around the idea of creating a comfortable place to call home.',
        'cover'    => '1448630360428-65456885c650',
    ],
    [
        'slug'     => 'bafana-residency',
        'name'     => 'Bafana Residency',
        'location' => 'Jahanuma',
        'status'   => 'delivered',
        'config'   => 'Residential development',
        'summary'  => "A residential development created with ConceptOne's commitment to practical and accessible living spaces.",
        'cover'    => '1479839672679-a46483c0e7c8',
    ],
];

/** Slugs shown in the home page's "Our Projects" section. */
const HOME_PROJECTS = ['kohinoor-20', 'le-crown', 'casa', 'anita', 'nest', 'bafana-residency'];

/** Stand-in photos for the ongoing-project tiles, one per project under development. */
const ONGOING_PHOTOS = ['1541888946425-d81bb19240f5', '1504307651254-35680f356dfd', '1503387762-592deb58ef4e', '1517089596392-fb9a9033e05b'];

/**
 * Founders. `photo` is the file stem in assets/img/team.
 * TODO: confirm the photo-to-name mapping and the spelling of the family name.
 */
const FOUNDERS = [
    [
        'name'       => 'Abdul Rab bin Abdullah Al Bosi',
        'short'      => 'Abdul Rab',
        'role'       => 'Founder & Director',
        'photo'      => 'abdullah',
        'credential' => "Master's Degree in Sales & Marketing · 12+ years in real estate, Jeddah",
        'intro'      => 'Returned from over 12 years in the Saudi Arabian real-estate market to build a company around affordability, trust and customer-centric development.',
        'bio'        => [
            'With over 12 years of real-estate experience in Jeddah, Saudi Arabia, Abdul Rab bin Abdullah Al Bosi returned to Hyderabad with a vision to create a real-estate company built around affordability, trust and customer-centric development.',
            "His personal experience of searching for his own dream home in Hyderabad became the inspiration behind ConceptOne's core philosophy.",
            'From starting SmartCity Developers to delivering projects through unprecedented challenges, his journey has been driven by one belief:',
        ],
        'quote'      => 'Everyone deserves the opportunity to own a good home.',
    ],
    [
        'name'       => 'Mohammed Albosi',
        'short'      => 'Mohammed',
        'role'       => 'Co-Founder & Director',
        'photo'      => 'mohammed',
        'credential' => 'Sales & Marketing · Real-estate experience, Saudi Arabia',
        'intro'      => 'A Saudi-returned professional who joined his brother with the same values, vision and determination.',
        'bio'        => [
            'A Saudi-returned professional with a strong background in Sales & Marketing and real-estate experience, Mohammed Albosi joined his brother with the same vision and commitment.',
            'Together, the brothers have transformed a shared idea into a growing real-estate development company.',
        ],
        'quote'      => '',
    ],
];

/**
 * Leadership beyond the two founders, shown under "Our Founders".
 * TODO: confirm Sana's role, bio and quote with the client.
 */
const LEADERSHIP = [
    [
        'name'       => 'Sana Salauddin',
        'short'      => 'Sana',
        'role'       => 'Director — Sales & Client Relations',
        'photo'      => 'sana-salauddin',
        'credential' => '',
        'intro'      => 'Leads sales, marketing and customer experience, guiding every buyer from the first site visit through registration and handover.',
        'bio'        => [
            'Sana Salauddin leads sales, marketing and customer experience at ConceptOne Developers.',
            'Her team walks every buyer through the home-buying journey, from the first site visit and payment options through registration and handover, so families always know what comes next.',
        ],
        'quote'      => 'A home is the biggest decision a family makes. They deserve clear answers.',
    ],
];

/** Our Journey: [when, title, text]. */
const JOURNEY = [
    ['2019', 'The first project', 'First project signed — Diamond Avenue, Puppalaguda.'],
    ['2020–21', 'Delivered through lockdown', 'Successfully delivered our first project despite unprecedented lockdown challenges.'],
    ['Next chapter', 'SmartCity Avenue', 'SmartCity Avenue successfully delivered at Sun City.'],
    ['' . REBRANDED, 'ConceptOne is born', 'SmartCity Developers evolved into ConceptOne Developers.'],
    ['2023–26', 'A growing portfolio', 'Expanded our portfolio with multiple residential developments across Hyderabad.'],
    ['Today', '11 delivered · 4 underway', '11 projects delivered, and 4 projects currently under development.'],
];

/** Why ConceptOne: [icon, title, text]. */
const PRINCIPLES = [
    ['home', 'Affordability', 'We believe quality living spaces should be accessible to more families.'],
    ['gem', 'Quality', 'Affordable should never mean compromising on quality, planning or functionality.'],
    ['file', 'Transparency', 'We believe customers deserve clarity throughout their property-buying journey.'],
    ['key', 'Easier Ownership', 'Our vision goes beyond selling a property. We aim to make the journey towards owning it simpler through suitable payment and installment solutions.'],
];

/** The One Concept, in practice: [icon, title, text]. */
const OFFERINGS = [
    ['home', 'Affordable Living Spaces', 'Quality homes thoughtfully planned around the needs of modern families.'],
    ['percent', 'Flexible EMI Options', 'Payment structures designed to make the purchasing journey more manageable, including No Cost EMI on ' . NO_COST_EMI_SHARE . '% of the price, directly from us.'],
    ['handshake', 'Halaal Installment Plans', "Options designed around the company's vision of providing interest-free, Halaal-oriented purchasing solutions, subject to the applicable structure and agreements."],
    ['trending-up', 'Investment Opportunities', 'Creating opportunities for customers and investors to participate in thoughtfully selected real-estate developments.'],
];

/** The challenges that changed the concept. */
const CHALLENGES = ['Home-loan eligibility', 'Large financial commitments', 'High interest costs', 'Long repayment periods', 'The pressure of monthly EMIs'];

/** Our Mission, as a formula. */
const MISSION_FORMULA = ['Quality Construction', 'Affordable Pricing', 'Transparent Processes', 'Flexible Payment Solutions'];

/** Our Values: [icon, title, text]. */
const VALUES = [
    ['shield', 'Integrity', 'We believe trust is the foundation of every successful relationship.'],
    ['badge', 'Commitment', 'When we commit to a project, we commit to delivering it.'],
    ['heart', 'Customer First', "Every home represents someone's dream, savings and future."],
    ['gem', 'Quality', 'We strive to create homes that offer lasting value.'],
    ['lightbulb', 'Innovation', 'We continuously look for better ways to make real estate more accessible.'],
    ['users', 'Community', "We don't just develop buildings. We create spaces where communities can grow."],
];

/** Contact: FAQs [question, answer]. */
const FAQS = [
    ['What does "One Concept" mean?', 'It is the philosophy behind our name: make quality homeownership affordable, accessible and easier for people and communities. Every ConceptOne project is built around it.'],
    ['How does No Cost EMI work?', 'You pay ' . NO_COST_EMI_SHARE . '% of the property price in equal monthly instalments directly to ' . SITE_SHORT . ', with zero interest and no bank involved. The balance ' . (100 - NO_COST_EMI_SHARE) . '% is paid as per the project\'s payment schedule. Our team will share the exact tenure and terms for your chosen home.'],
    ['Do you offer Halaal installment plans?', 'Our vision includes interest-free, Halaal-oriented purchasing solutions. Availability and the exact structure depend on the project and are set out in your agreement. Our team will walk you through the terms, and we encourage you to review them with your own adviser.'],
    ['Can I invest in a ConceptOne project?', 'Yes. We create opportunities for customers and investors to participate in thoughtfully selected real-estate developments. Talk to our team about current opportunities.'],
    ['Which projects are available right now?', 'We currently have ' . STATS['ongoing']['n'] . ' projects under development across ' . CITY . '. Share your preferred location and budget, and our team will tell you what is available.'],
    ['How do I schedule a site visit?', 'Send us an enquiry, call or WhatsApp us, and we will arrange a convenient slot. Our Toli Chowki office is open ' . HOURS . '.'],
];

/** Enquiry "interested in" options: general topics, then delivered projects. */
function interest_options(): array
{
    $topics   = ['Ongoing projects', 'Schedule a site visit', 'No Cost EMI & installment plans', 'Investment opportunities', 'General enquiry', 'Land owner / joint development'];
    $projects = array_map(fn ($p) => 'Homes like ' . $p['name'], PROJECTS);

    return array_merge($topics, $projects);
}

/** Enquiry budget bands. */
const BUDGETS = ['Under ₹50 L', '₹50 L – ₹1 Cr', '₹1 – 2 Cr', 'Above ₹2 Cr', 'Not decided yet'];
