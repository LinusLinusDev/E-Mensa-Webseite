<!---
- Author: Linus Palm
- Date: 14.01.2022
--->
<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('emensa_log');
$logger->pushHandler(new StreamHandler('../storage/log/emensa.log', Logger::INFO));

return $logger;
