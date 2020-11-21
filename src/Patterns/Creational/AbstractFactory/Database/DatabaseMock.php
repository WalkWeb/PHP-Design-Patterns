<?php

declare(strict_types=1);

namespace Patterns\Creational\AbstractFactory\Database;

class DatabaseMock implements DatabaseInterface
{
    private static $spells = [
        1 => [
            'id'    => 1,
            'type'  => 1,
            'name'  => 'Легкое лечение',
            'power' => 30,
        ],
        2 => [
            'id'    => 2,
            'type'  => 2,
            'name'  => 'Огненный шар',
            'power' => 50,
        ],
    ];

    /**
     * @param int $id
     * @return array
     * @throws DatabaseException
     */
    public function findOneById(int $id): array
    {
        if (!array_key_exists($id, self::$spells)) {
            throw new DatabaseException(DatabaseException::UNDEFINED_SPELL);
        }

        return self::$spells[$id];
    }
}
