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
