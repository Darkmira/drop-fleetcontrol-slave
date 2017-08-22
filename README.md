Drop fleet control slave
========================

Service running on Raspberry that listens for master orders,
and execute them by calling robot move scripts.


## Install

Requires on the Raspberry Pi:

 - git, docker, docker-compose
 - folder with 4 php scripts `forward.php`, `backward.php`, `right.php`, `left.php`

Fetch this repo:

``` bash
git clone https://github.com/alcalyn/drop-fleetcontrol-slave.git
cd drop-fleetcontrol-slave/
```

Configure in `.env` file:

```
# Your Raspberry unique name
COLOR=green

# Your RabbitMq host and exchange name
RABBITMQ_HOST=rabbitmq
RABBITMQ_PORT=5672
RABBITMQ_USER=guest
RABBITMQ_PASS=guest

RABBITMQ_EXCHANGE=orders

# Path to your scripts (let it as is if running in docker)
ROBOT_SCRIPTS_DIR=/var/robot-scripts
```


Install and run the service:

``` bash
make
```
