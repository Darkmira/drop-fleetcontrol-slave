FROM sergeytykhonov/rpi-php:7-alpine

RUN	apk update && \
	apk upgrade && \
	apk add --update curl openssl && \
	curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
	chmod +x /usr/local/bin/composer && \
	apk del curl openssl && \
	rm -rf /var/cache/apk/*

RUN docker-php-ext-install bcmath
