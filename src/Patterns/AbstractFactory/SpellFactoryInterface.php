<?php

declare(strict_types=1);

namespace Patterns\AbstractFactory;

use Patterns\AbstractFactory\Database\DatabaseException;
use Patterns\AbstractFactory\Spell\SpellInterface;

interface SpellFactoryInterface
{
    /**
     * @param int $id
     * @return SpellInterface
     * @throws DatabaseException
     */
    public function create(int $id): SpellInterface;
}
