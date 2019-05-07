<p align="center">Cron Parser</p>

## What
Cron parser is a command line app that can explains/simplify the cron that is given. 

## Why 
I built the cron parser in php using TDD  (Test-driven development)
This was an exercise to familiarise myself with TDD approaches and understand how it works. 

## Pre-requisites

- Docker running on the host machine.
- Basic knowledge of Docker.

## Versions:
- PHP ^7.2

## Getting Started

To get started, the following steps needs to be taken:

- Clone the repository
- Run `make up`  (Only on the first time)
- Run `make rebuild` (Next time you need to rebuild)

Once built you can run: 

- Run `make run_app cron="<INSERT CRON HERE>"`  e.g. `*/15 0 1,15 * 1-5 /usr/bin/find`

## Examples

- make run_app cron="*/15 0 1,15 * 1-5 /usr/bin/find"
- make run_app cron="0 0,12 1 */2 * /usr/bin/find"
- make run_app cron="0 4,17 * * sun,mon /scripts/script.sh"

## Makefile
The Makefile provides few convenient and useful commands:
- `make rebuild` : Rebuild the containers
- `make install` : Install composer inside container
- `make up` : Rebuild container and install composer inside it
- `make shell` : Run an interactive shell with the php container
- `make bash` : Run an interactive bash shell with the php container
- `make tests-unit` : Runs all of codecept unit tests
- `make tests-integration` : Runs all of codecept integration tests
- `make run_app` : Run the command line application
