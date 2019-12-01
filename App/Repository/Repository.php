<?php declare(strict_types=1);

namespace App\Repository;

use Core\Database;

abstract class Repository
{
    public function beginTransaction(): void
    {
        $database = Database::getInstance();
        $database->beginTransaction();
    }

    public function commit(): void
    {
        $database = Database::getInstance();
        $database->commit();
    }

    public function rollBack(): void
    {
        $database = Database::getInstance();
        $database->rollBack();
    }

    /**
     * find by id
     * @param int $id
     * @return mixed
     */
    abstract public function find(int $id);

    /**
     * find all
     * @return mixed
     */
    abstract public function findAll();
}
