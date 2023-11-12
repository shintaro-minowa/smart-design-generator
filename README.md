# 開発環境構築手順
```
git clone [リポジトリのURL]

cd smart-design-generator

docker-compose up --build -d

cp .env.example .env

docker exec -it laravel_app /bin/bash

composer install

php artisan key:generate

php artisan migrate

exit

open http://localhost:8080
```