<?php

/*
|--------------------------------------------------------------------------
| Portfolio content
|--------------------------------------------------------------------------
|
| Everything the site displays lives here. Edit this file to change copy,
| add a job, swap a skill or update contact details — no Blade edits needed.
| Run `php artisan config:clear` afterwards if you have cached config.
|
*/

return [

    // Appended to css/js URLs so visitors get fresh files after a deploy.
    'version' => env('ASSET_VERSION', '1'),

    'profile' => [
        'name'       => 'Syed Shajahan Basha',
        'first'      => 'Syed Shajahan',
        'last'       => 'Basha',
        'short'      => 'Shajahan Basha',
        'title'      => 'Full-Stack Technical Lead',
        'location'   => 'Hyderabad, India',
        'available'  => true,
        'lede'       => 'I lead teams and write the code. Thirteen years of turning product ideas into software that ships — web platforms, mobile apps and cloud architecture that hold up under real users.',
        'cv'         => 'assets/syed-shajahan-basha-cv.pdf',
        'meta'       => 'Syed Shajahan Basha, AWS & Microsoft certified Full-Stack Technical Lead in Hyderabad. 13+ years building web apps, mobile apps and cloud platforms with PHP, Laravel, Node, React and AWS.',
        'images'     => [
            'avatar'   => 'assets/avatar.jpg',
            'hero'     => 'assets/hero.jpg',
            'portrait' => 'assets/portrait.jpg',
            'office'   => 'assets/office.jpg',
        ],
    ],

    // Cycled by the typewriter in the hero.
    'roles' => [
        'Full-Stack Technical Lead',
        'AWS Solutions Architect',
        'Laravel & Node Developer',
        'Flutter & Ionic App Builder',
    ],

    'stats' => [
        ['value' => 13, 'suffix' => '+', 'label' => 'Years building'],
        ['value' => 50, 'suffix' => '+', 'label' => 'Projects shipped'],
        ['value' => 7,  'suffix' => '',  'label' => 'Roles held'],
        ['value' => 4,  'suffix' => '',  'label' => 'Certifications'],
    ],

    // Order here drives the rail, the dot rail and the slide order.
    'menu' => [
        ['id' => 'home',    'label' => 'Home',     'icon' => 'bi-house'],
        ['id' => 'about',   'label' => 'About',    'icon' => 'bi-person-badge'],
        ['id' => 'skills',  'label' => 'Skills',   'icon' => 'bi-stack'],
        ['id' => 'deliver', 'label' => 'Deliver',  'icon' => 'bi-box-seam'],
        ['id' => 'certs',   'label' => 'Certs',    'icon' => 'bi-patch-check'],
        ['id' => 'hire',    'label' => 'Hire Me',  'icon' => 'bi-hand-thumbs-up'],
        ['id' => 'career',  'label' => 'Career',   'icon' => 'bi-briefcase'],
        ['id' => 'contact', 'label' => 'Contact',  'icon' => 'bi-envelope'],
    ],

    // Floating labels around the hero portrait.
    'chips' => [
        ['icon' => 'bi-cloud-check', 'text' => 'AWS Solutions Architect', 'class' => 'chip-a'],
        ['icon' => 'bi-code-slash',  'text' => 'Laravel · Node · React',  'class' => 'chip-b float d1'],
        ['icon' => 'bi-geo-alt',     'text' => 'Hyderabad, India',        'class' => 'chip-c float d2'],
    ],

    'about' => [
        'heading'    => 'Thirteen years, one <span class="grad-text">consistent habit</span>: ship it properly.',
        'paragraphs' => [
            "I'm <strong>Shajahan Basha Syed</strong> — an AWS &amp; Microsoft certified full-stack developer and technical lead with more than 13 years of experience building custom websites, scalable web apps, mobile apps and cloud-based enterprise solutions.",
            "I'm based in <strong>Hyderabad, India</strong>, and I work with clients across the world — from small startups to large organisations — to build software that is fast, easy to use and reliable.",
        ],
        'points' => [
            ['icon' => 'bi-diagram-3',        'title' => 'Architecture first', 'note' => 'Decisions documented before code'],
            ['icon' => 'bi-people',           'title' => 'Teams led',          'note' => 'Hiring, reviews, Agile delivery'],
            ['icon' => 'bi-lightning-charge', 'title' => 'Hands-on',           'note' => 'Still in the pull requests'],
            ['icon' => 'bi-globe2',           'title' => 'Remote-ready',       'note' => 'Clients across UAE, UK, India'],
        ],
    ],

    // The 3D ring. Keep this list at 15 for an even circle, or adjust
    // the --i step in app.css (360 / count) if you change the number.
    'skills' => [
        ['icon' => 'bi-filetype-php',        'name' => 'PHP'],
        ['icon' => 'bi-layers',              'name' => 'Laravel'],
        ['icon' => 'bi-fire',                'name' => 'CodeIgniter'],
        ['icon' => 'bi-hexagon',             'name' => 'Node.js'],
        ['icon' => 'bi-radioactive',         'name' => 'React.js'],
        ['icon' => 'bi-bounding-box',        'name' => 'AngularJS'],
        ['icon' => 'bi-filetype-html',       'name' => 'HTML5'],
        ['icon' => 'bi-filetype-css',        'name' => 'CSS3'],
        ['icon' => 'bi-bootstrap',           'name' => 'Bootstrap'],
        ['icon' => 'bi-phone-flip',          'name' => 'Flutter'],
        ['icon' => 'bi-lightning',           'name' => 'Ionic'],
        ['icon' => 'bi-android2',            'name' => 'Android'],
        ['icon' => 'bi-apple',               'name' => 'iOS'],
        ['icon' => 'bi-database',            'name' => 'MySQL'],
        ['icon' => 'bi-database-fill-gear',  'name' => 'MongoDB'],
    ],

    'skills_summary' => 'PHP · Laravel · CodeIgniter · Node · React · Angular · Flutter · Ionic · MySQL · MongoDB · AWS',

    'deliver' => [
        ['icon' => 'bi-window-stack',    'title' => 'Custom, responsive websites', 'note' => 'Built for SEO and speed, not just for the design mockup.'],
        ['icon' => 'bi-rocket-takeoff',  'title' => 'Enterprise platforms & SaaS', 'note' => 'Multi-tenant products that scale with the customer count.'],
        ['icon' => 'bi-phone',           'title' => 'Mobile apps, online or off',  'note' => 'Flutter and Ionic apps that keep working without signal.'],
        ['icon' => 'bi-shield-lock',     'title' => 'Secure APIs & integration',   'note' => 'New services wired into the systems you already run.'],
        ['icon' => 'bi-kanban',          'title' => 'Agile delivery',              'note' => 'Sprints, demos and a status you never have to chase.'],
        ['icon' => 'bi-tools',           'title' => 'Support after launch',        'note' => 'Maintenance and technology choices that age well.'],
    ],

    'certifications' => [
        [
            'icon'   => 'bi-cloud-check',
            'title'  => 'AWS Certified Solutions Architect',
            'issuer' => 'Associate level',
            'detail' => 'Designing resilient, cost-aware AWS architecture — VPC, EC2, S3, RDS, IAM and deployment pipelines.',
        ],
        [
            'icon'   => 'bi-database',
            'title'  => 'MTA: Database Fundamentals',
            'issuer' => 'Microsoft Technology Associate',
            'detail' => 'Relational modelling, normalisation, indexing and query design — the groundwork under every schema I ship.',
        ],
        [
            'icon'   => 'bi-microsoft',
            'title'  => 'Microsoft Certified Professional',
            'issuer' => 'Microsoft Corporation',
            'detail' => 'Verified competence across Microsoft development platforms and tooling.',
        ],
        [
            'icon'   => 'bi-robot',
            'title'  => 'AI Tools & ChatGPT',
            'issuer' => 'Be10X certification',
            'detail' => 'Applying AI tooling to development workflows — code review, documentation and faster prototyping.',
        ],
    ],

    'hire' => [
        [
            'title'    => 'For a full-time role',
            'audience' => 'Employers',
            'items'    => [
                ['icon' => 'bi-clock-history', 'title' => 'Extensive technical tenure',       'note' => '13+ years across product, agency and enterprise teams'],
                ['icon' => 'bi-people',        'title' => 'Strategic leadership & execution', 'note' => 'A proven record of managing and growing delivery teams'],
                ['icon' => 'bi-code-square',   'title' => 'Advanced tech proficiency',        'note' => 'Genuine full-stack depth, front-end through database'],
                ['icon' => 'bi-cloud',         'title' => 'AWS certified architect',          'note' => 'Cloud infrastructure planned, secured and costed'],
            ],
        ],
        [
            'title'    => 'For a freelance project',
            'audience' => 'Clients',
            'items'    => [
                ['icon' => 'bi-lightbulb',       'title' => 'Low-code visionary',                'note' => 'Working prototypes in days, not quarters'],
                ['icon' => 'bi-rocket',          'title' => 'Innovative product development',    'note' => 'Creative solutions for genuinely hard problems'],
                ['icon' => 'bi-cloud-arrow-up',  'title' => 'Cloud-first expertise',             'note' => "Modern architecture that won't need rebuilding"],
                ['icon' => 'bi-chat-dots',       'title' => 'Reliable, transparent communication','note' => 'Clear timelines, regular updates, honest collaboration'],
            ],
        ],
    ],

    // Newest first — the deck numbers itself automatically.
    'career' => [
        [
            'span'    => 'Feb 2026 — Present',
            'role'    => 'Tech Project Lead',
            'company' => 'Abou Naja Intellectual Property · UAE (Remote)',
            'summary' => 'Leading technology projects and development teams with a focus on scalable software architecture, hands-on development and technical delivery. I drive architecture decisions, code quality, Agile delivery, CI/CD and technical research.',
            'tags'    => ['Laravel', 'React', 'Python', 'PostgreSQL', 'AWS'],
        ],
        [
            'span'    => 'Mar 2024 — Feb 2026',
            'role'    => 'Senior PHP Developer',
            'company' => 'George Institute for Global Health · Hyderabad',
            'summary' => 'Led platform development and managed teams, set technical standards, supported infrastructure upgrades and contributed to research proposals — with continuous improvement and cross-team collaboration throughout.',
            'tags'    => ['PHP', 'Team management', 'Infrastructure'],
        ],
        [
            'span'    => 'May 2021 — Mar 2024',
            'role'    => 'Full Stack Lead',
            'company' => 'ZerocodeHR LLP · Hyderabad',
            'summary' => 'Front-end development for the TCC Low Code Platform, alongside building HR products on low-code and no-code platforms.',
            'tags'    => ['Low-code', 'Front-end', 'HR products'],
        ],
        [
            'span'    => 'Jun 2019 — Apr 2021',
            'role'    => 'Lead Technical Specialist',
            'company' => 'SSS Solutions · Hyderabad · Self-employed',
            'summary' => 'Internal product architect driving product development initiatives, overseeing business operations, and contributing hands-on coding to client service projects.',
            'tags'    => ['Product architecture', 'Operations', 'Client delivery'],
        ],
        [
            'span'    => 'Jan 2017 — May 2019',
            'role'    => 'Team Lead',
            'company' => 'Wenso Creative Solutions Pvt Ltd · Hyderabad',
            'summary' => 'Owned client relationships and requirements, led a team of developers, and stayed hands-on coding web applications alongside them.',
            'tags'    => ['Client management', 'Team lead', 'Web apps'],
        ],
        [
            'span'    => 'Sep 2015 — Dec 2016',
            'role'    => 'PHP Developer',
            'company' => 'Verve Mobile Pvt Ltd · Hyderabad',
            'summary' => 'Built backend APIs in PHP for mobile apps, with front-end and UI design work, plus hybrid mobile apps in AngularJS and Ionic.',
            'tags'    => ['PHP APIs', 'AngularJS', 'Ionic'],
        ],
        [
            'span'    => 'Jun 2013 — Sep 2015',
            'role'    => 'Where it started',
            'company' => 'Freelance · Hyderabad',
            'summary' => 'Started out in web design and PHP website development, working with startup companies to build their first online platforms.',
            'tags'    => ['Web design', 'PHP', 'Startups'],
        ],
    ],

    'contact' => [
        'email'   => env('CONTACT_TO_ADDRESS', 'shajahanbasha.syed@gmail.com'),
        'phones'  => ['+91 96666 68397' => '+919666668397', '+91 99494 27002' => '+919949427002'],
        'address' => 'Diamond Hills Colony, G K Enclave, Qutub Shahi Tombs, Shaikpet, Tolichowki, Hyderabad 500008',
        'intents' => ['Job opportunity', 'Freelance project', 'General enquiry'],
    ],

    'social' => [
        ['icon' => 'bi-linkedin', 'label' => 'LinkedIn', 'url' => 'https://www.linkedin.com/in/shajahanbasha-syed'],
        ['icon' => 'bi-whatsapp', 'label' => 'WhatsApp', 'url' => 'https://wa.me/919666668397'],
        ['icon' => 'bi-envelope', 'label' => 'Email',    'url' => 'mailto:shajahanbasha.syed@gmail.com'],
    ],

];
