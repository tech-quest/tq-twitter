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
# ex. $ make add-migrate FILENAME=AddUsersTable
add-migrate:
	docker exec tq-docker-template_php_1 vendor/bin/phinx create $(FILENAME)