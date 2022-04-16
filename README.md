# simple-tweet-redis
 A very simple clone of twitter that's used redis as a key value storage to store tweets.

## Run project
- Clone project
- CMD composer install
- Copy .env.example file to .env
- Open .env file and change the database configuration (DB_DATABASE,DB_USERNAME,DB_PASSWORD)
- CMD php artisan key:generate
- CMD php artisan migrate
- CMD php artisan serve

## Redis
- sudo service redis-server start
- redis-cli 
- 127.0.0.1:6379> ping
PONG