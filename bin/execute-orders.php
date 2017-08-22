<?php

require_once __DIR__.'/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use Drop\FleetControl\RobotApi;
use Drop\FleetControl\Application;

$connection = new AMQPStreamConnection(
    getenv('RABBITMQ_HOST'),
    getenv('RABBITMQ_PORT'),
    getenv('RABBITMQ_USER'),
    getenv('RABBITMQ_PASS')
);

$robotApi = new RobotApi(getenv('ROBOT_SCRIPTS_DIR'));
$application = new Application($connection, getenv('COLOR'), getenv('RABBITMQ_EXCHANGE'), $robotApi);

echo 'listening rabbitmq message from queue ', getenv('COLOR'), PHP_EOL;

$application->executeOrders();
