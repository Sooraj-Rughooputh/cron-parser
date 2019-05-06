docker_sh   = docker exec -w /app -it shell
docker_sh_c = $(docker_sh) /bin/bash -c

build:
	@docker-compose down
	@docker-compose build --no-cache 
	@docker-compose up -d

install:
	@$(docker_sh_c) "composer install"

shell:
	@$(docker_sh_c) "export COLUMNS=`tput cols`; export LINES=`tput lines`; exec bash"

run_app:
	@$(docker_sh_c) "./cpa.php \"$(cron)\""

bash:
	@$(docker_sh) bash

up: build install

tests-unit:
	@$(docker_sh) php vendor/bin/codecept run unit

tests-integration:
	@$(docker_sh) php vendor/bin/codecept run integration
