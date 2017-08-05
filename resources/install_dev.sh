#!/usr/bin/env bash

composer install
npm install
npm install -g bower
bower install
grunt build
php bin/console assets:install --symlink
php bin/console assetic:dump --env=dev --no-debug
php bin/console cache:clear --env=dev --no-warmup
php bin/console server:run