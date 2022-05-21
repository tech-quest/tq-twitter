.PHONY: init
init: 
	@make up
	@make composer-install

.PHONY: up
up:
	./docker-compose-local.sh up -d

.PHONY: stop
stop:
	./docker-compose-local.sh stop

.PHONY: down
down:
	./docker-compose-local.sh down

.PHONY: destroy
destroy: 
	./docker-compose-local.sh down --rmi all --volumes --remove-orphans

.PHONY: refresh
refresh:
	@make destroy
	@make up
	@make composer-install

.PHONY: migrate
migrate:
	docker exec tq-docker-template_php_1 vendor/bin/phinx migrate -e development

.PHONY: rollback
rollback:
	docker exec tq-docker-template_php_1 vendor/bin/phinx rollback -e development

.PHONY: rollback-all
rollback-all:
	docker exec tq-docker-template_php_1 vendor/bin/phinx rollback -e development -t 0

# e.g. $ make add-migration FILENAME=AddUsersTable
.PHONY: add-migration
add-migration:
	docker exec tq-docker-template_php_1 vendor/bin/phinx create $(FILENAME)

.PHONY: composer-install 
composer-install:
	./composer.sh install