<?php declare(strict_types=1);

namespace Core;

use Core\Util\SemanticConverter;
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
     * @param array $ids
     * @return array|Repository[]
     */
    public function findByIds(array $ids): array
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
                $models[] = $this->fillModel($row);
            }

            return $models;
        } catch (\PDOException $exception) {
            return [];
        }
    }

    /**
     * @return array|Repository[]
     */
    public function findAll(): array
    {
        $database = Database::getInstance();

        try {
            $statement = $database->prepare('SELECT * FROM `' . self::MODEL . '`');
            $models = [];

            foreach ($statement->fetchAll() as $row){
                $models[] = $this->fillModel($row);
            }

            return $models;
        } catch (\PDOException $exception) {
            return [];
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
                $methods[$method->getName()] = lcfirst(str_replace($needle, '', $method->getName()));
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
    {
        $className = self::MODEL;
        $class     = new $className();

        foreach ($row as $key => $item) {
            if (strpos($key, '_id') !== false) {
                $subClassRepositoryName = SemanticConverter::snakeCaseToPascalCase(str_replace('_id', '', $key)) . __CLASS__;

                /** @var self $subClassRepository */
                $subClassRepository = new $subClassRepositoryName();

                $row[$key] = $subClassRepository->find($item);
            }
        }

        foreach ($row as $key => $item) {
            if (strpos($key, '_ids') !== false) {
                $subClassRepositoryName = SemanticConverter::snakeCaseToPascalCase(str_replace('_ids', '', $key)) . __CLASS__;

                /** @var self $subClassRepository */
                $subClassRepository = new $subClassRepositoryName();

                $serializer = new Serializer(null, Serializer::ENCODER_JSON);

                $row[$key] = $subClassRepository->findByIds($serializer->decode($item));
            }
        }

        foreach ($this->getModelMethods('set') as $methodName => $propertyName) {
            $class->$methodName($row[$propertyName]);
        }

        return $class;
    }

}
