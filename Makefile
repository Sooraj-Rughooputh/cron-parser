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
	@$(docker_sh_c) "echo $(cron)"

up: build install

test:
	# you need to implement this
	echo "not implemented"

.PHONY: build install shell up test
