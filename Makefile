init: 
	@make destroy
	@make up
	@make composer-install
up:
	./docker-compose-local.sh up -d
stop:
	./docker-compose-local.sh stop
down:
	./docker-compose-local.sh down
destroy: 
	./docker-compose-local.sh down --rmi all --volumes --remove-orphans
migrate:
	docker exec tq-docker-template_php_1 vendor/bin/phinx migrate -e development
rollback:
	docker exec tq-docker-template_php_1 vendor/bin/phinx rollback -e development
rollback-all:
	docker exec tq-docker-template_php_1 vendor/bin/phinx rollback -e development -t 0
# e.g. $ make add-migration FILENAME=AddUsersTable
add-migration:
	docker exec tq-docker-template_php_1 vendor/bin/phinx create $(FILENAME)
composer-install:
	./composer.sh install