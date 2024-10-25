# Challenge Arena

Краткое описание проекта

## Документация

[Документация находится здесь](documentation)

## Installation

```bash
git clone
cd
composer install
```

Скопировать файл .env.example в .env и настроить подключение к базе данных

```bash
cp .env.example .env
```

```bash
php artisan key:generate
```

```bash
php artisan migrate
```

```bash
php artisan db:seed
```

```bash
php artisan storage:link
```

## Установка в Docker

Если нет make, то взять команды из makefile и выполнять напрямую

Запуск контейнера.

```bash
make up
```

Открыть консоль:

```
make shell
```

В консоли продолжить обычную установку с шага composer install
