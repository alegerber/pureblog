<?php declare(strict_types=1);

namespace App\Repository;

use Core\Database;
use ReflectionClass;

abstract class Repository
{
    /** @var string */
    public const MODEL = '';

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
     * @return null|Repository
     */
    public function find(int $id): ?Repository
    {
        $database = Database::getInstance();

        try {
            $statement = $database->prepare('SELECT * FROM `' . self::MODEL . '` WHERE `id` = :id');
            $statement->execute([':id' => $id]);
            $row = $statement->fetch();

            return $this->fillModel($row);
        } catch (\PDOException $exception) {
            return null;
        }
    }

    /**
     * find by id
     * @param array $ids
     * @return null|Repository
     */
    public function findByIds(array $ids): ?Repository
    {
        $database = Database::getInstance();

        try {
            $sql = 'SELECT * FROM `' . self::MODEL . '` WHERE `id` IN (';
            foreach ($ids as $id) {
                $sql .= $id . ',';
            }
            substr($sql, 0, -1);
            $sql .= ')';

            $statement = $database->query($sql);
            $models = [];

            foreach ($statement->fetchAll() as $row){
                $models = $this->fillModel($row);
            }

            return $models;
        } catch (\PDOException $exception) {
            return null;
        }
    }

    /**
     * find all
     * @return mixed
     */
    public function findAll(): ?Repository
    {
        $database = Database::getInstance();

        try {
            $statement = $database->prepare('SELECT * FROM `' . self::MODEL . '`');
            $models = [];

            foreach ($statement->fetchAll() as $row){
                $models = $this->fillModel($row);
            }

            return $models;
        } catch (\PDOException $exception) {
            return null;
        }
    }

    /**
     * @param string $needle
     * @return array
     * @throws \ReflectionException
     */
    private function getModelMethods(string $needle): array
    {
        $reflectionClass = new ReflectionClass(self::MODEL);
        $methods = [];

        foreach ($reflectionClass->getMethods() as $method) {
            if (strpos($method->getName(), $needle) === 0) {
                // @TODO id & ids
                $methods[$method->getName()] = strtolower(str_replace($needle, '', $method->getName()));
            }
        }

        return $methods;
    }

    /**
     * @param array $row
     * @return Repository
     * @throws \ReflectionException
     */
    private function fillModel(array $row): Repository
    {   $className = self::MODEL;
        $class     = new $className();

        foreach ($this->getModelMethods('set') as $methodName => $propertyName) {
            $class->$methodName($row[$propertyName]);
        }

        return $class;
    }

}
