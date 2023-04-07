#!/bin/bash

tests:
	php bin/console doctrine:database:drop --force --env=test || true
	php bin/console doctrine:database:create --env=test
	php bin/console doctrine:migrations:migrate -n --env=test
	php bin/php bin/phpunit $@
.PHONY: tests