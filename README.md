# CV Submission and Review Platform with PHPUnit Testing

Platform for users to submit their CVs, along with basic personal information. Administrators can securely log in to review submitted applications. The project includes a PHPUnit testing suite for ensuring application reliability.

### Prerequisites

- [Git](https://git-scm.com/)
- [Composer](https://getcomposer.org/)
- [PHP](https://www.php.net/)

### Installation

1. Clone the repository
2. Run the following cmds
 ```bash
composer install
```
 ```bash
cp .env.example .env
```
```bash
php artisan key:generate
 ```
```bash
php artisan storage:link
```
 ```bash
 php artisan migrate:fresh --seed
```
 ```bash
 php artisan test
```
## Admin Credentials
Admin link:  (http://your_link/login)

Admin: 
```bash 
admin_app@gmail.com
```
Password: 
```bash
12345678
```
