# Places

Tämä kloonaa projektin kyseiseen hakemistoon missä olet:
git clone https://github.com/mtunkelo/MapApp.git


Tämä kloonaa projektin MapApp hakemistoon:
git clone https://github.com/mtunkelo/MapApp.git MapApp

$ composer update

$ cd .env.example .env

$ php artisan key:generate  
$ php artisan config:clear

Remember to set db connections

### Run these to add sample data to database
$ php artisan migrate  
$ php artisan db:seed

### Then just serve
$ php artisan serve
