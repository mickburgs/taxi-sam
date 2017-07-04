#!/usr/bin/env bash

composer install
npm install
npm install -g bower
bower install
grunt build
php bin/console assets:install --symlink