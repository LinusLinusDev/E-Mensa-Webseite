<?php
/**
 * Praktikum DBWT. Authors:
 *David Rechkemmer, 3074595
 *Linus Palm, 3271087
 */

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('emensa_log');
$logger->pushHandler(new StreamHandler('../storage/log/emensa.log', Logger::INFO));

return $logger;
