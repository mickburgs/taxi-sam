#!/usr/bin/env bash

php bin/console cache:clear --env=prod --no-warmup
php bin/console cache:warmup --env=prod

php bin/console assets:install --env=prod
php bin/console assetic:dump --env=prod --no-debug
