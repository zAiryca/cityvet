# CityVet — Local Windows Setup (VSCode + XAMPP)

This guide shows how to run CityVet locally on Windows using VSCode and XAMPP, how to build frontend assets, and how to schedule or run pet transition tasks manually.

## Prerequisites

- Git
- VSCode
- XAMPP (Apache + MySQL) with PHP 8.2+
- Composer (global or use `C:\\xampp\\php\\php.exe composer.phar`)
- Node.js (18 or 20+) and npm

## Open project in VSCode

1. Clone or copy the repo into `C:\\xampp\\htdocs\\cityvet`.
2. In VSCode: `File → Open Folder...` → select `C:\\xampp\\htdocs\\cityvet`.
3. Open integrated terminal (`View → Terminal`).

## Start XAMPP

1. Launch XAMPP Control Panel.
2. Start **Apache** and **MySQL**.

## Configure environment

1. Copy `.env.example` to `.env`:
    - PowerShell: `Copy-Item .env.example .env`
    - CMD: `copy .env.example .env`
    - Git Bash: `cp .env.example .env`
2. Edit `.env` in VSCode and update the following at minimum:
    - `APP_URL=http://localhost` (or `http://localhost/cityvet/public`)
    - Database settings:
        ```text
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=cityvet_db
        DB_USERNAME=root
        DB_PASSWORD=
        ```

## Create database & import

1. Open http://localhost/phpmyadmin
2. Create a database named `cityvet_db`.
3. Import your SQL dump (e.g., `cityvet_db_export.sql`) via phpMyAdmin → Import.

## Install dependencies & build

In VSCode terminal (project root):

```bash
composer install
npm install
npm run build    # production assets -> public/build
```

For development with hot reload (local only):

```bash
npm run dev
```

## Laravel setup

```bash
php artisan key:generate
php artisan storage:link
php artisan migrate    # only if you want to run migrations locally
php artisan db:seed    # optional
php artisan config:cache
```

## Serve the app

- XAMPP: open `http://localhost/cityvet/public` (or set up an Apache virtual host pointing to the `public/` folder).
- Or use the dev server: `php artisan serve --host=127.0.0.1 --port=8000` and open `http://127.0.0.1:8000`.

## Task scheduler / pet transitions (Windows)

The repo includes `run-pet-transitions.bat` (used to run scheduled pet transition jobs). Use one of the following:

Manual run (from VSCode terminal):

```bash
# From project root, using PHP from XAMPP
C:\\xampp\\php\\php.exe artisan schedule:run
# or run the provided batch file (double-click or run in terminal)
run-pet-transitions.bat
```

Schedule with Windows Task Scheduler (recommended for offline host):

1. Open **Task Scheduler** (Windows).
2. Create a new Basic Task → give it a name (e.g., `CityVet Pet Transitions`).
3. Trigger: choose a schedule (e.g., Daily, Every 5 minutes via Advanced settings).
4. Action: **Start a program**.
    - Program/script: `C:\\Windows\\System32\\WindowsPowerShell\\v1.0\\powershell.exe` (or `cmd.exe`)
    - Add arguments (PowerShell example):
        ```text
        -NoProfile -WindowStyle Hidden -Command "C:\\xampp\\php\\php.exe -f 'C:\\xampp\\htdocs\\cityvet\\artisan' schedule:run"
        ```
    - Or point to the batch file: `C:\\xampp\\htdocs\\cityvet\\run-pet-transitions.bat`
5. Save task. It will invoke Laravel's scheduler or the batch file on the chosen interval.

Notes:

- If the task runs commands that write files, ensure the account running the task has permission to the project folder and `storage/` and `bootstrap/cache`.
- For quick testing, run the batch file manually to confirm output.

## Recommended screenshots for documentation

- VSCode with project opened
- XAMPP Control Panel with Apache & MySQL running
- phpMyAdmin create DB screen
- phpMyAdmin import progress
- Terminal running `composer install` and `npm run build`
- `php artisan migrate` output
- Browser showing `http://localhost/...` with app UI or static demo
- Task Scheduler entry showing the created task

## Static demo option (no DB)

If you just want to show UI without connecting a DB, add `public/index.html` with mock content (the project already supports this approach). For a quick preview, create that file and push.

---

If you want, I can also create a short `README-windows-short.md` for inclusion in your Word doc.
