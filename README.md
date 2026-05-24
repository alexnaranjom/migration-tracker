# Migration Tracker

A Laravel application that tracks the progress of migrating a legacy CodeIgniter application to Laravel. Built to manage modules, migration steps, notes, and overall progress with AI-powered analysis.

## Tech Stack

- **Backend:** Laravel 13, PHP 8.4
- **Database:** SQLite
- **Testing:** PHPUnit (feature tests)
- **AI:** Anthropic API (Claude) for migration step suggestions
- **Frontend:** Vue 3 (coming soon)

## Features

- Track migration modules with status workflow (not started, analyzing, in progress, testing, completed)
- Priority levels (low, medium, high, critical) for module planning
- Migration steps checklist per module
- Migration notes for documentation, decisions, and issue tracking
- Dashboard API with overall progress statistics
- AI-powered analysis that suggests specific migration steps per module
- RESTful API with Form Request validation and proper HTTP status codes

## Installation

```bash
git clone https://github.com/alexnaranjom/migration-tracker.git
cd migration-tracker
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

The app runs at `http://localhost:8000`.

## API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | /api/dashboard | Migration progress statistics |
| GET | /api/modules | List all modules (filter: ?status=) |
| POST | /api/modules | Create a new module |
| GET | /api/modules/{id} | Show module with notes and steps |
| PUT | /api/modules/{id} | Update a module |
| DELETE | /api/modules/{id} | Delete a module |
| PATCH | /api/modules/{id}/status | Update module status |
| GET | /api/modules/{id}/notes | List module notes |
| POST | /api/modules/{id}/notes | Add a note to a module |
| POST | /api/modules/{id}/ai-analyze | AI-generated migration steps |

## Testing

```bash
php artisan test
```

10 feature tests covering CRUD operations, validation, status filtering, and dashboard statistics.

## Author

Alex Naranjo - [LinkedIn](https://www.linkedin.com/in/alex-naranjom/) - [Portfolio](https://alexnaranjom.github.io/portfolio/)
