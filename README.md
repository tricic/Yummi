# Yummi

Yummi is a pizza ordering system built using [the Laravel framework](https://laravel.com/).

### Demo
Heroku: [https://tricic-yummi.herokuapp.com/](https://tricic-yummi.herokuapp.com/)

Test user: email: test@mail.net | password: password
## Features

- Registration & Login
- Menu with items of different sizes
- Item search
- Shopping cart
- Ordering system
- USD / EUR currency converter
- Order history (requires login)

## Technologies used
- [Laravel 8](https://laravel.com/docs/8.x/installation)
- [jQuery](https://jquery.com/)
- [Bootstrap 4](https://getbootstrap.com/)
- More: [Fontawesome](https://fontawesome.com/), [Bootbox.js](http://bootboxjs.com/), [money.js](http://openexchangerates.github.io/money.js/)

## Installation
### Requirements
- [PHP](https://www.php.net/) >=7.3.0
- [MySQL](https://www.mysql.com/) (or other Laravel supported database)
- [Composer](https://getcomposer.org/)
- [npm](https://www.npmjs.com/get-npm)

### Installation
```bash
git clone https://github.com/tricic/Yummi.git
cd yummi

composer install
npm install && npm run dev

cp .env.example .env
```
Create database, edit **.env** file and **configure database** settings, then run


```bash
php artisan key:generate
php artisan migrate --seed
php artisan serve --port=8000
```
That's it. Open [http://localhost:8000/](http://localhost:8000/) in your browser to run the application.

### Test
Create new database (e.g. 'yummi_testing') and edit DB_DATABASE_TEST in **.env** file, then run
```bash
php artisan migrate --seed --database=mysql_testing
```
Now you can run tests with
```bash
php artisan test
```

## License
[MIT](https://choosealicense.com/licenses/mit/)
