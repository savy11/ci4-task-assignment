## Prerequisites

PHP 8.1+ with PDO/MySQL extension
MySQL 5.7+ or MariaDB 10.2+
Composer
Git

## Installation

1. Clone the repo:
git clone https://github.com/grok-ai/ci4-task-app.git
cd ci4-task-app

2. Install dependencies (CI4 core is included; no extras needed):
composer install

3. Copy .env.example to .env (if not present) and configure:
database.default.hostname = localhost
database.default.database = ci4_tasks_db
database.default.username = root
database.default.password = your_password
database.default.DBDriver = MySQLi
app.baseURL = 'http://localhost:8080/'

4. Run migrations to set up the database:
php spark migrate

5. Start the development server:
php spark serve

6. Web Interface:
Register: http://localhost:8080/register
Login: http://localhost:8080/login
After login: Redirects to /tasks (list/create/edit/delete via forms)
Logout: Add a link in views


7. API Endpoints

Auth:
POST /auth/register - Create user (returns JWT-like session token in response)
POST /auth/login - Login (returns session token)

Tasks (Authenticated):
GET /tasks - List user's tasks
POST /tasks - Create task
PUT /tasks/{id} - Update task
DELETE /tasks/{id} - Delete task


Responses are JSON. Errors use CI4's standard format.

## Notes on Approach

 - Views: Simple PHP files with forms (POST to same controller). Shared layout.php for header/footer (includes logout link).
 - Controllers: Added showForm* methods for GET requests (render views). POST/PUT/DELETE return JSON (API compat). Detects request type via $this->request->isAJAX() or content-type.
 - Auth: On successful login/register, redirect to /tasks. Filter protects task views.
 - Security: CSRF protection auto-enabled in forms (CI4 default). Validation on all inputs.
 - Assumptions: No images/JS—pure HTML. Status toggle via edit form.
 - Testing: Browser for views; check DB after actions.

If issues, see logs in writable/logs/.