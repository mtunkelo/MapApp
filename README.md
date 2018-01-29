# Places

git clone https://github.com/mtunkelo/MapApp.git

composer install

cd .env.example .env
php artisan key:generate

Set db connections

Run:
php artisan migrate
php artisan db:seed

Then just serve:
php artisan serve
