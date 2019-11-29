<?php declare(strict_types=1);


namespace App\Core;


final class Database extends \PDO
{
    /**
     * @var Database
     */
    private static $instance;

    /**
     * gets the instance via lazy initialization (created on first usage)
     */
    public static function getInstance(): self
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * is not allowed to call from outside to prevent from creating multiple instances,
     * to use the singleton, you have to obtain the instance from Singleton::getInstance() instead
     */
    private function __construct()
    {
        parent::__construct('mysql:dbname=database;host=mysql','user', 'password');
    }

}
