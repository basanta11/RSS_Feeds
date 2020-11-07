<?php
namespace App\Logging;

use Exception;
use Monolog\Logger;
use Logger\Monolog\Handler\MysqlHandler;
use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\RotatingFileHandler;

class JsonFormatLogging
{
    /**
     * Create a custom Monolog instance.
     *
     * @param  array $config
     * @return Logger
     * @throws Exception
     */
    public function __invoke($logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            //changing format from line to Json
            $handler -> setFormatter(new JsonFormatter());

        }
    }
        
}