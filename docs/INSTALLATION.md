# Installation Guide — CityVet

This guide shows how to install and run CityVet both locally (offline) and online (production).

## Quick overview

- Local: Use XAMPP (Windows) or native PHP + MySQL. Good for development and testing.
- Online: Deploy to a Linux VPS or shared host — install PHP, Composer, Node, and configure web server.

---

## Requirements

- PHP 8.2 with extensions: `pdo`, `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`, `fileinfo`, `gd` or `imagick`
- MySQL / MariaDB (or other supported DB)
- Composer
- Node.js (LTS) + npm
- Git (optional)
- For Windows local: XAMPP (includes Apache + PHP + MySQL)

Packages used by the app (from composer.json / package.json):

- Composer: `laravel/framework`, `livewire/livewire`, `barryvdh/laravel-dompdf`, `maatwebsite/excel`, `doctrine/dbal`, etc.
- NPM: `vite`, `tailwindcss`, `alpinejs`, `axios`, `laravel-vite-plugin`, `postcss`, `autoprefixer`.

---

## Local (Windows with XAMPP)

1. Install prerequisites:
    - Install XAMPP (https://www.apachefriends.org)
    - Install Composer (https://getcomposer.org)
    - Install Node.js and npm (https://nodejs.org)

2. Place project in `C:\xampp\htdocs` (already `C:\xampp\htdocs\cityvet`).

3. Start XAMPP Control Panel and start `Apache` and `MySQL`.

4. Open PowerShell and run:

```powershell
cd C:\xampp\htdocs\cityvet
composer install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

5. Open Git Bash (or PowerShell) and install frontend packages:

```bash
cd /c/xampp/htdocs/cityvet
npm install
npm run dev
```

6. Serve the app (development):

```powershell
php artisan serve
# open http://127.0.0.1:8000
```

Or use Apache with document root pointing to `C:\xampp\htdocs\cityvet\public` and visit `http://localhost/cityvet`.

7. Run scheduled transitions manually (optional):

```powershell
php artisan pets:transition-impounded-to-adoptable
php artisan pets:transition-adoptable-to-unadopted
```

Use the included `run-pet-transitions.bat` to run both commands together for Windows Task Scheduler.

---

## Local (Linux / macOS)

1. Install PHP 8.2, Composer, Node.js, MySQL.
2. Clone repository and run the same commands as above (use paths appropriate for your machine):

```bash
git clone <repo-url> cityvet
cd cityvet
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install
npm run dev
php artisan serve
```

3. To run scheduled tasks automatically, add a cron entry:

```cron
* * * * * cd /home/USER/cityvet && php artisan schedule:run >> /dev/null 2>&1
```

---

## Production (Online) Deployment Checklist

1. Server requirements: PHP 8.2, MySQL, Composer, Node.js (or build locally), nginx or Apache.
2. Clone repo to server and set environment variables (`.env`) with production DB and app URL.
3. Install PHP dependencies:

```bash
composer install --no-dev --optimize-autoloader
```

4. Build assets:

```bash
npm ci
npm run build
```

5. Set permissions (example for Linux):

```bash
chown -R www-data:www-data /path/to/cityvet
chmod -R 775 storage bootstrap/cache
```

6. Configure web server to point to `/path/to/cityvet/public`.
7. Run migrations and seeders if needed:

```bash
php artisan migrate --force
php artisan db:seed --force
```

8. Configure supervisor (or systemd) for queue workers (if using queues) and add cron for scheduler:

Cron example (run every minute):

```cron
* * * * * cd /path/to/cityvet && php artisan schedule:run >> /dev/null 2>&1
```

---

## Recommended images and assets

- Site logo: `logo.png` and `logo.webp` — keep SVG if possible (vector).
- Placeholder pet photo: `pet-placeholder.jpg` — 1024×768 (store web-friendly copies: 800×600, 400×300).
- Announcement / poster images: max width 1200px, save as `jpg` or `webp` compressed.
- Thumbnails: 400×300, use `webp` for best compression.
- Recommended formats: `webp` (preferred), fallback `jpg`/`png` for compatibility.

Naming suggestions (store in `public/storage` or `/storage/app/public`):

- `logo.svg`, `logo-200.png`
- `pets/{id}.webp` and `pets/{id}-thumb.webp`

Notes:

- Keep originals if you need higher-resolution for exports.
- Use progressive JPEGs or WebP to speed up page loads.

---

## Troubleshooting & tips

- If you see permission errors: ensure `storage/` and `bootstrap/cache` are writable by web server.
- If assets don't load: run `npm run dev` locally or `npm run build` for production and verify `vite` config.
- If scheduled transitions don't run: verify cron/Task Scheduler or run the commands manually to check logs.

---

If you'd like, I can add the above to `README.md` or create screenshots / a Task Scheduler `.xml` export for import.
