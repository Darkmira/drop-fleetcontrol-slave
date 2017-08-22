<?php

namespace Drop\FleetControl;

class RobotApi
{
    /**
     * @var string
     */
    private $scriptsDir;

    /**
     * @param string $scriptsDir
     */
    public function __construct($scriptsDir)
    {
        $this->scriptsDir = $scriptsDir;
    }

    /**
     * @param string $order
     *
     * @return string result of script.
     *
     * @throws \RuntimeException when order not available.
     */
    public function executeOrder($order)
    {
        $availableOrders = [
            'forward',
            'backward',
            'right',
            'left',
        ];

        if (!in_array($order, $availableOrders)) {
            throw new \RuntimeException('Order not available: "'.$order.'"');
        }

        return shell_exec("php {$this->scriptsDir}/$order.php");
    }
}
