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
	./docker-compose-local.sh run php vendor/bin/phinx migrate -e development

.PHONY: rollback
rollback:
	./docker-compose-local.sh run php vendor/bin/phinx rollback -e development

# e.g. $ make add-migrate FILENAME=AddUsersTable
.PHONY: add-migration
add-migrate:
	./docker-compose-local.sh run php vendor/bin/phinx create $(FILENAME)

.PHONY: composer-install 
composer-install:
	./composer.sh install
