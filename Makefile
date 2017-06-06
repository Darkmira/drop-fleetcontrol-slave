all:
	docker-compose up -d --no-deps slave-php

	docker exec -ti slave-php /bin/sh -c "composer install"

	docker-compose up -d

bash:
	docker exec -ti slave-php /bin/sh
