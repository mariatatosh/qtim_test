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