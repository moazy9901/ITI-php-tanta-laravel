## Purpose
Short, actionable guidance to help AI coding agents be productive in this Laravel project.

Keep suggestions focused on the actual repository conventions, build/test workflows, and concrete file examples.

## Quick project summary
- Framework: Laravel (project skeleton)
- PHP: ^8.2 (see `composer.json`)
- Laravel version: `laravel/framework` ^12 (see `composer.json`)
- Frontend build: Vite (`package.json`, `vite.config.js`, `resources/js`)

## Key commands (use these exact scripts when possible)
- Setup (install deps, env, migrate, build): `composer run-script setup` (see `composer.json` scripts)
- Dev (start server, queue, logs, vite): `composer run dev` — launches `php artisan serve`, `php artisan queue:listen`, `npm run dev` via `concurrently` (see `composer.json`)
- Tests: `composer run test` (runs `@php artisan test`) or `vendor/bin/phpunit -c phpunit.xml`

## Where to look (examples in this repo)
- Routes: `routes/web.php` (app entry points; simple route to `resources/views/welcome.blade.php`)
- Controllers: `app/Http/Controllers/` (business logic and request handling)
- Models: `app/Models/` (Eloquent models, e.g. `app/Models/User.php`)
- Views: `resources/views/` (Blade templates, e.g. `welcome.blade.php`)
- Frontend assets: `resources/js/`, `resources/css/` and Vite plugin in `package.json`/`vite.config.js`
- Migrations & seeders: `database/migrations/`, `database/seeders/`
- Factories: `database/factories/` (used in tests)
- Tests: `tests/Feature/` and `tests/Unit/` (phpunit.xml uses sqlite :memory: for tests)

## Notable repository-specific behaviors and patterns
- Tests are configured for an in-memory SQLite DB (see `phpunit.xml`): test runs should not need a local DB setup. Keep tests compatible with sqlite in-memory constraints.
- Autoloading uses PSR-4 with the `App\\` namespace mapped to `app/` (see `composer.json`). When adding classes, use this namespace and run `composer dump-autoload` if necessary.
- The project uses `npx concurrently` in `composer.json` `dev` script to run multiple processes. Agent suggestions that change dev scripts must preserve `concurrently` usage or provide a compatible alternative.
- Queue behavior in dev: `php artisan queue:listen --tries=1` is part of the dev script. Be careful when proposing changes to queue configuration — tests use `QUEUE_CONNECTION=sync` in `phpunit.xml`.

## Testing and CI hints
- Use `composer run test` for local test runs. The test environment is configured in `phpunit.xml` (APP_ENV=testing, QUEUE_CONNECTION=sync, DB_DATABASE=:memory:).
- When editing migrations or factories, run the test suite to verify compatibility with sqlite in-memory.

## Safe-edit rules for AI suggestions
- Preserve public APIs and routes unless a migration plan is provided (list of files to update and tests to adjust).
- Avoid adding runtime secrets to repo files. Follow existing `.env` pattern (repo uses `.env.example` in setup scripts).
- When changing composer or npm dependencies, update `composer.json`/`package.json` and verify `composer install` / `npm ci` and `composer run test` locally.

## Concrete examples to reference in suggestions
- To run full setup: the repo exposes `composer run-script setup` which copies `.env.example` to `.env`, runs `artisan key:generate` and `artisan migrate` and builds assets.
- Tests: `phpunit.xml` sets `DB_CONNECTION=sqlite` and `DB_DATABASE=:memory:` so create/seed logic in tests should work without external DB.

## Where to add new features
- Routes -> `routes/web.php` (or `routes/api.php` if creating API endpoints)
- Controllers -> `app/Http/Controllers/` (create a controller per resource)
- Models -> `app/Models/`
- Migrations -> `database/migrations/`
- Factories -> `database/factories/` for test data

## When in doubt
- Follow existing patterns in `app/` (namespaces, folder structure). Use `composer dump-autoload` after adding new classes.
- Run `composer run test` after non-trivial changes and ensure CI-like test environment (sqlite in-memory) is respected.

If anything here is unclear or you'd like the agent to document deeper patterns (for example, auth scaffolding or specific middleware conventions), tell me which areas to expand.
