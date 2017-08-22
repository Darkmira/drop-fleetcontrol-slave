#!/bin/sh

until php `dirname $0`/check-rabbitmq.php > /dev/null
do
    echo 'Waiting for RabbitMQ starting...'
    sleep 1
done

echo 'RabbitMQ is now running.'

echo 'Running next command:'
echo "$@"

exec "$@"
