install:
	composer install

lint:
	composer run-script phpcs -- --standard=PSR2 app

lint-fix:
	composer run-script phpcbf -- --standard=PSR2 app

test:
	composer run-script phpunit tests