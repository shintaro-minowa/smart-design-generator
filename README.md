# 環境構築手順
```
docker-compose up -d --build

docker-compose exec app php artisan key:generate

docker-compose exec app php artisan migrate

open http://localhost:8080
```