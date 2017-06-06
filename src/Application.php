<?php

namespace Drop\FleetControl;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class Application
{
    /**
     * @var AMQPStreamConnection
     */
    private $connection;

    /**
     * @var string
     */
    private $color;

    /**
     * @var string
     */
    private $exchangeName;

    /**
     * @var RobotApi
     */
    private $robotApi;

    /**
     *
     * @param AMQPStreamConnection $connection
     * @param string $color
     * @param string $exchangeName
     * @param RobotApi $robotApi
     */
    public function __construct(AMQPStreamConnection $connection, $color, $exchangeName, RobotApi $robotApi)
    {
        $this->connection = $connection;
        $this->color = $color;
        $this->exchangeName = $exchangeName;
        $this->robotApi = $robotApi;
    }

    /**
     * Listens to RabbitMQ messages and execute orders on receive.
     */
    public function executeOrders()
    {
        $channel = $this->connection->channel();

        $channel->exchange_declare($this->exchangeName, 'direct');

        list($queueName, ,) = $channel->queue_declare($this->color, false, false, true, false);

        $channel->queue_bind($queueName, $this->exchangeName, $this->color);

        $callback = function ($message) {
            try {
                echo $this->robotApi->executeOrder($message->body), PHP_EOL;
            } catch (\RuntimeException $e) {
                echo $e->getMessage(), PHP_EOL;
            }
        };

        $channel->basic_consume($queueName, '', false, true, false, false, $callback);

        while (count($channel->callbacks)) {
            $channel->wait();
        }

        $channel->close();
        $this->connection->close();
    }
}
