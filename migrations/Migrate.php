<?php declare(strict_types=1);

require __DIR__ . '/../Core/Database.php';

class Migrate
{
    /**
     * @var App\Core\Database $database
     */
    private $database;

    public function __construct()
    {
        $this->database = App\Core\Database::getInstance();
        $this->execute('
            SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
            SET AUTOCOMMIT = 0;
            START TRANSACTION;
            SET time_zone = "+00:00";
        ');
    }

    public function __destruct()
    {
        $this->execute('COMMIT;');
    }

    /**
     * @param string $statement
     */
    protected function execute(string $statement): void
    {
        if(1 === $this->database->exec($statement)){
            echo $statement;
        }
    }
}
