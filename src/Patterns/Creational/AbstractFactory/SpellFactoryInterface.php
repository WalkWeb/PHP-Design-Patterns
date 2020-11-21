<?php

declare(strict_types=1);

namespace Patterns\Creational\AbstractFactory;

use Patterns\Creational\AbstractFactory\Database\DatabaseException;
use Patterns\Creational\AbstractFactory\Spell\SpellInterface;

interface SpellFactoryInterface
{
    /**
     * @param int $id
     * @return SpellInterface
     * @throws DatabaseException
     */
    public function create(int $id): SpellInterface;
}
