## Activity
This is a sample Laravel + AngularJS application.
Make sure you have PHP, MySQL and Apache installed.


Clone this repo
```
$ git clone https://github.com/90lucasgabriel/activity
```
Fix php artisan
```
$ composer update --no-scripts
```
Generate Laravel App Key
```
$ php artisan key:generate
```
-Create database
-Insert into .env: database, user and password.

Seed database
```
$ php artisan migrate:refresh --seed
```
cd into the activity folder run npm install
```
$ npm install
```
Serve the app
```
$ php artisan serve
```

Head to http://localhost:8000 in your browser and you'll see the app running
