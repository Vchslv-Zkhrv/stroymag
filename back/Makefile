build:
	docker network create stroymag_common
	docker compose build
	docker compose run composer install
	chmod 777 -R app/
	cp app/config/config.template.json app/config/config.json
	cp app/.env.local.example app/.env.local
	@echo "\e[1;37m\e[44m                                                                    \e[0m"
	@echo "\e[1;37m\e[44m  Update app/config/config.json and app/.env.local to finish setup  \e[0m"
	@echo "\e[1;37m\e[44m                                                                    \e[0m"
run:
	docker compose up -d php nginx
down:
	docker compose down
logs:
	docker compose logs
status:
	docker compoe ps
clear:
	rm -rf app/vendor
	rm app/composer.lock
	rm app/symfony.lock
	rm app/compose.yaml
	rm app/compose.override.yaml
update:
	docker compose run composer update
app-cache:
	docker compose run php /usr/local/bin/php bin/cache.php
symfony-cache:
	docker compose run php /usr/local/bin/php bin/console cache:clear
cache:
	docker compose run php /usr/local/bin/php bin/console cache:clear
	docker compose run php /usr/local/bin/php bin/cache.php
migrate:
	docker compose run php /usr/local/bin/php bin/console doctrine:migration:migrate
entity:
	docker compose run php /usr/local/bin/php bin/console make:entity
migration:
	docker compose run php /usr/local/bin/php bin/console make:migration
services:
	docker compose run php /usr/local/bin/php bin/console debug:container
autowiring:
	docker compose run php /usr/local/bin/php bin/console debug:autowiring
