# Fix Missing 'role' Column in Users Table

## Steps:
- [x] 1. Edit `database/migrations/0001_01_01_000000_create_users_table.php` to add `$table->string('role')->default('user');`
- [x] 2. Edit `app/Models/User.php` to add `'role'` to `#[Fillable(...)]`
- [x] 3. Run `php artisan migrate:fresh`
- [x] 4. Run `php artisan db:seed`
- [ ] 5. Verify seeders ran successfully and test login (admin@bughive.dev / password)

**Progress: Migrations and seeders complete. Verify login at http://localhost:8000/login with admin@bughive.dev / password.**
