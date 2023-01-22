up: docker-up
rebuild: docker-down docker-build docker-up
stop: docker-stop
down: docker-down

docker-up:
	docker compose up -d

docker-down:
	docker compose down --remove-orphans -v

docker-build:
	docker compose pull
	docker compose build

docker-stop:
	docker compose stop

migrations-run:
	docker compose run --rm api-php-cli php bin/console doctrine:migrations:migrate -q

migrations-diff:
	docker compose run --rm api-php-cli php bin/console doctrine:migrations:diff