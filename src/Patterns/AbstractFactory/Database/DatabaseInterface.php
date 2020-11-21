<?php

declare(strict_types=1);

namespace Patterns\AbstractFactory\Database;

interface DatabaseInterface
{
    /**
     * @param int $id
     * @return array
     * @throws DatabaseException
     */
    public function findOneById(int $id): array;
}
