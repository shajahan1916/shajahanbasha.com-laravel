# Syed Shajahan Basha — Portfolio

A single-page portfolio built on **Laravel 13**. Eight full-screen slides driven by a
vertical slider, a fixed left rail for navigation, glassmorphic UI and 3D content
transitions on every slide change.

All the content lives in one config file. There is no database and no front-end
build step.

---

## Requirements

- PHP 8.3 or newer
- Composer
- A mail account for the contact form (SMTP, Mailgun, SES, Postmark — anything Laravel supports)

No MySQL, no Node, no `npm run build`.

---

## Getting it running

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```

Open http://localhost:8000.

That is the whole setup. Sessions, cache and the queue all use the filesystem, so
nothing needs migrating.

---

## Editing the content

**Everything the site displays is in `config/portfolio.php`.** You should not need
to touch a Blade file to keep the site current.

| What you want to change | Where |
| --- | --- |
| Name, title, bio, CV path, images | `profile` |
| The roles the hero types out | `roles` |
| The four counters | `stats` |
| Slide order and the left rail | `menu` |
| Floating labels on the portrait | `chips` |
| About copy and the four small cards | `about` |
| The 3D technology ring | `skills` |
| "What I deliver" cards | `deliver` |
| Certifications (front and flip side) | `certifications` |
| The two "why hire me" columns | `hire` |
| Every job in the career deck | `career` |
| Email, phones, address, enquiry types | `contact` |
| Social icons | `social` |

The templates count these arrays themselves, so:

- Adding a job adds a card to the career deck and renumbers the stamps.
- Adding a skill re-spaces the 3D ring automatically (`360° ÷ number of skills`).
- Adding or removing a menu entry adds or removes a whole slide, a rail item and a
  navigation dot — as long as a matching Blade file exists at
  `resources/views/sections/{id}.blade.php`.
- Headings like "Six things you can hand me" and "Seven roles" re-word themselves.

After editing, if you have cached your config, run:

```bash
php artisan config:clear
```

---

## The contact form

Enquiries are validated server-side, then emailed to `CONTACT_TO_ADDRESS`
(falling back to the address in `config/portfolio.php`).

Set your mail credentials in `.env`:

```dotenv
MAIL_MAILER=smtp
MAIL_HOST=smtp.yourhost.com
MAIL_PORT=587
MAIL_USERNAME=you@yourdomain.com
MAIL_PASSWORD=secret
MAIL_SCHEME=tls
MAIL_FROM_ADDRESS="no-reply@yourdomain.com"
MAIL_FROM_NAME="Syed Shajahan Basha"

CONTACT_TO_ADDRESS=shajahanbasha.syed@gmail.com
```

While developing, leave `MAIL_MAILER=log` and read the messages in
`storage/logs/laravel.log`.

**What is built in:**

- Server-side validation with readable messages (`app/Http/Requests/ContactRequest.php`)
- A honeypot field bots fill in and humans never see
- Rate limiting at 6 submissions per minute per IP
- `Reply-To` set to the sender, so hitting reply in your inbox answers them directly
- Submits over `fetch`, so the visitor keeps their place in the slider
- Works without JavaScript too — it falls back to a normal POST, redirect and flash message
- If SMTP fails, the enquiry is written to the log and the visitor is shown your email address rather than an error page

The email template is `resources/views/emails/contact.blade.php`.

---

## Your CV

The Download CV button and the rail icon both point at `/cv`, which streams
whatever file is named in `config/portfolio.php` under `profile.cv`:

```
public/assets/syed-shajahan-basha-cv.pdf
```

**Replace that placeholder file with your real CV.** If the file is missing the
route returns a polite 404 instead of an exception.

---

## Project layout

```
app/Http/Controllers/PortfolioController.php   page + CV download
app/Http/Controllers/ContactController.php     form handling
app/Http/Requests/ContactRequest.php           validation rules
app/Mail/ContactMessage.php                    the enquiry email
config/portfolio.php                           ← all site content
resources/views/layouts/app.blade.php          head, shell, script tags
resources/views/portfolio.blade.php            loops the menu into slides
resources/views/partials/                      rail, topbar, dots, preloader, background
resources/views/sections/                      one file per slide
resources/views/emails/contact.blade.php       enquiry email template
public/css/app.css                             all styling
public/js/app.js                               slider, 3D animations, form
public/assets/                                 images + CV
routes/web.php                                 three routes
tests/Feature/                                 page and contact-form tests
```

---

## Front-end notes

Bootstrap, Bootstrap Icons, Swiper, GSAP and vanilla-tilt load from cdnjs — see the
bottom of `resources/views/layouts/app.blade.php`. To self-host them, drop the files
into `public/vendor/` and swap those URLs for `asset()` calls.

There is no asset pipeline. Edit `public/css/app.css` or `public/js/app.js` directly,
then bump `ASSET_VERSION` in `.env` so browsers pick up the change:

```dotenv
ASSET_VERSION=2
```

**Behaviour by screen size:** at 992px and wider the page is a Swiper slider — one
section per screen, moved by wheel, arrow keys, rail, dots or swipe. Below that it
becomes an ordinary scrolling page with the same 3D reveals driven by ScrollTrigger.
If Swiper fails to load, the desktop view degrades to that scrolling mode too.
`prefers-reduced-motion` turns the motion off everywhere.

---

## Tests

```bash
php artisan test
```

Covers page rendering, that every configured job and skill reaches the HTML,
form validation, the honeypot, and the no-JavaScript redirect path.

---

## Deploying

### VPS / Forge / any server you control

Point the web root at **`public/`**, never at the project root.

```bash
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Make sure `storage/` and `bootstrap/cache/` are writable by the web server.

Set in `.env`:

```dotenv
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

### Shared hosting (cPanel)

If you cannot move the document root, upload the project outside `public_html`,
copy the contents of `public/` into `public_html`, and edit the two paths near the
top of `public_html/index.php` to point at your project directory.

Re-run `php artisan config:clear` after changing `.env` on a cached deployment —
`config:cache` snapshots your environment values.

---

## Ideas for later

- Move `config/portfolio.php` into database tables plus a small admin screen, so the
  content is editable without deploying
- A blog: add a `posts` table, a route and one more slide
- Swap cdnjs for self-hosted assets if you want the site to work fully offline
- Add a sitemap and `robots.txt` entries once the domain is live
