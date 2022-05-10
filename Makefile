SHELL := /bin/bash

tests:
	symfony console doctrine:database:drop --force --env=test || true
	symfony console doctrine:database:create --env=test
	symfony console doctrine:migrations:migrate -n --env=test
	symfony console doctrine:fixtures:load -n --env=test
	symfony php -dxdebug.mode=coverage bin/phpunit --coverage-clover /home/pictime/.cache/JetBrains/PhpStorm2021.3/coverage/arena@phpunit_xml_dist.xml --configuration /home/pictime/arena/phpunit.xml.dist $@
.PHONY: tests


reset-db: ## Reset de database
	symfony console doctrine:database:drop --if-exists --force -n
	symfony console doctrine:database:create -n
	symfony console doctrine:migration:migrate -n
	symfony console doctrine:fixtures:load -n
.PHONY: reset-db

start:
	docker-compose up -d
	symfony server:stop
	symfony server:start -d
.PHONY: start

stop:
	symfony server:stop
	docker-compose down
.PHONY: stop






