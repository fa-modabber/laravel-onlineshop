

# Laravel Project Setup & Usage

## Tech Stack
- Backend: Laravel
- Database: MySQL
- Front-end: Bootstrap and Blade

## Requirements

- PHP >= 8.x
- Composer
- MySQL (or other supported database)


## Setup
1. Clone the repository
```
git clone 
cd <project-directory>
```
2. Install dependencies
```
composer install
```
3. Run Webserver and Database
- Start your local webserver
- Make sure MySQL or your preferred database server is running 
4. Create a new database for the project
5. Configure environment
Update the database settings in .env:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```
6. Run migrations
```
php artisan migrate
```
7. Seed the database
```
php artisan db:seed
```


## Running Automated Tests
```
php artisan test
```

