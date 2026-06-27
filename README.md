# Online College Voting System - Module 1

Steps to get started locally (XAMPP):

1. Copy `college-voting-system/` into your XAMPP `htdocs` folder.
2. Start Apache and MySQL via XAMPP.
3. Import the database:
   - Using phpMyAdmin: import `database/db.sql`
   - Or from command line: `mysql -u root -p < database/db.sql`
4. Adjust DB credentials in `includes/config.php` if your MySQL user isn't root/empty password.
5. Create an initial admin:
   - From CLI: `php database/seed_admin.php`
   - Or open `http://localhost/college-voting-system/database/seed_admin.php` (not recommended publicly)
6. Visit `http://localhost/college-voting-system/` in your browser.

Notes:
- Password for the seeded admin is 'admin123' (change it after first login).
- The project uses procedural PHP and mysqli. Future modules will add login, sessions and CRUD pages.
