PROJECT_NAME=My Symfony
DOCKER_ENABLED=1
NPM_DEVELOPMENT_PORT ?= 9000
NPM_DEVELOPMENT_START_SCRIPT=start -- --port ${NPM_DEVELOPMENT_PORT}
SLACK_CHANNEL_ID=C02HRC33LFL

-include .env
-include .env.local

COMPOSER_BIN=bin/composer.phar

include .devops/makes/symfony.mk
