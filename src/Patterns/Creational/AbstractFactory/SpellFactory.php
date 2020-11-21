<?php

declare(strict_types=1);

namespace Patterns\Creational\AbstractFactory;

use Patterns\Creational\AbstractFactory\Database\DatabaseException;
use Patterns\Creational\AbstractFactory\Database\DatabaseInterface;
use Patterns\Creational\AbstractFactory\Spell\DamageSpell;
use Patterns\Creational\AbstractFactory\Spell\HealSpell;
use Patterns\Creational\AbstractFactory\Spell\SpellFactoryException;
use Patterns\Creational\AbstractFactory\Spell\SpellInterface;

class SpellFactory implements SpellFactoryInterface
{
    /**
     * @var DatabaseInterface
     */
    private $database;

    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
    }

    /**
     * @param int $id
     * @return SpellInterface
     * @throws DatabaseException
     * @throws SpellFactoryException
     */
    public function create(int $id): SpellInterface
    {
        $data = $this->database->findOneById($id);

        // todo здесь должна быть валидация данных, для простоты примера пропускаем

        if ($data['type'] === SpellInterface::TYPE_HEAL) {
            return new HealSpell($data['id'], $data['type'], $data['name'], $data['power']);
        }

        if ($data['type'] === SpellInterface::TYPE_DAMAGE) {
            return new DamageSpell($data['id'], $data['type'], $data['name'], $data['power']);
        }

        throw new SpellFactoryException(SpellFactoryException::UNDEFINED_TYPE);
    }
}
