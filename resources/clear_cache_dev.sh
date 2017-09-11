#!/usr/bin/env bash

php bin/console cache:clear --env=dev --no-warmup
php bin/console assets:install --symlink
php bin/console assetic:dump --env=dev --no-debug
