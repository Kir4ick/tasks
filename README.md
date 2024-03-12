REST API для задач
---------------
---------------

Начало работы: 
---------------

1. В корневом каталоге приложения выполнить установку пакетов composer:
```shell script
docker-compose -f docker/docker-compose.yml  run  --rm --no-deps --entrypoint='' app bash -c "composer install --prefer-dist"
```
2. Запустить контейнеры приложения:
```shell script
docker-compose -f docker/docker-compose.yml up -d
```
3. Скопировать .env.example в корень с названием .env (также заполнить passphare GhI89ZZ0GhI89ZZ0, а также подключение к бд)


4. Выполнить миграции и сделать засев бд
```shell script
docker-compose -f docker/docker-compose.yml  run  --rm --no-deps --entrypoint='' app bash -c "php artisan migrate && php artisan db:seed"
```
5. Всячина для работы с laravel
```shell script
docker-compose -f docker/docker-compose.yml  run  --rm --no-deps --entrypoint='' app bash -c "php artisan key:generate"
```
_____

Документация Swagger находится по ссылке:
---------------
{host}/api/documentation

P.S. 
---------------
---------------

Также для всех запросов нужен JWT токен, в .env есть все данные для составления его в jwt.io

Да я понимаю, что хранить ключи для jwt так просто как здесь, 
нельзя, но это просто тестовое же.

Также насчет доекрфайла, да у laravel 9 есть sail, 
но я чет не нашел как именно 9 с ним скачать
