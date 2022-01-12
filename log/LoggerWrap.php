<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

final class LoggerWrap
{
    private static ?Logger $logger = null;

    private function __construct()
    {
    }

    private static function getLogger() : Logger {
        if(self::$logger === null){
            self::$logger = new Logger('emensa_log');
            self::$logger->pushHandler(new StreamHandler('../storage/log/emensa.log', Logger::INFO));
        }
        return self::$logger;
    }

    public static function log(string $message) {
        self::getLogger()->info($message);
    }

    public static function warn(string $message){
        self::getLogger()->warning($message);
    }
}
