#!/bin/sh
set -e

if [ ! -f .env ]; then
    cp .env.example .env
    sed -i "s/^APP_KEY=.*/APP_KEY=$(tr -dc 'A-Za-z0-9' </dev/urandom | head -c 32)/" .env
fi

if [ ! -d vendor ]; then
    composer install
fi

if [ ! -f database/database.sqlite ]; then
    mkdir -p database
    touch database/database.sqlite
fi

php artisan migrate:fresh --seed 2>/dev/null || true
php artisan jwt:secret 2>/dev/null || true

exec "$@"
