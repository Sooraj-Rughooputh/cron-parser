Instructions
=============

## How start docker container:

`make up`

## How to run tests (after you've implemented them - please make sure you app runs all tests you have via this command)

`make test`

## Enter container

`make shell`

## Run cron parser
`make run_app cron="*/15 0 1,15 * 1-5 /usr/bin/find"`