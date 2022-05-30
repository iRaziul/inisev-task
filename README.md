# Task Completed for INISEV

## Installation

Clone the repository

```sh
composer install
cp .env.example .env
php artisan key:generate
```

Change the database details in .env and run the migrations

```sh
php artisan migrate --seed
```

Admin credentials:

Email: `admin@mail.com` Password: `admin`

---

**Change the email credentials in `.env` or `config/mail.php`**

Serve the application

```sh
php artisan serve
```

Run Queue Worker

```sh
php artisan queue:work
```

---

NOTE: I have just tried to implement the features as mentioned in the given TASK. If I missed something please let me know.
