install:
	composer install --ignore-platform-reqs
test:
	composer run-script phpunit tests
run: 
	php -S localhost:8000 -t public
logs:
	tail -f storage/logs/lumen.log