<?php

require_once __DIR__.'/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

try {
    $connection = new AMQPStreamConnection(
        getenv('RABBITMQ_HOST'),
        getenv('RABBITMQ_PORT'),
        getenv('RABBITMQ_USER'),
        getenv('RABBITMQ_PASS')
    );

    $connection->close();

    echo 'RabbitMQ ON'.PHP_EOL;

    exit(0);
} catch (\ErrorException $e) {
    echo 'RabbitMQ OFF'.PHP_EOL;

    exit(1);
}
