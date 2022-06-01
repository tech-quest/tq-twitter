up:
	./docker-compose-local.sh up -d
stop:
	./docker-compose-local.sh stop
down:
	./docker-compose-local.sh down
destroy: 
	./docker-compose-local.sh down --rmi all --volumes --remove-orphans
migrate:
	./docker-compose-local.sh run php vendor/bin/phinx migrate -e development
rollback:
	./docker-compose-local.sh run php vendor/bin/phinx rollback -e development
# ex. $ make add-migrate FILENAME=AddUsersTable
add-migrate:
	./docker-compose-local.sh run php vendor/bin/phinx create $(FILENAME)