<?php

declare(strict_types=1);

namespace Tests\Creational\AbstractFactory;

use Patterns\Creational\AbstractFactory\Database\DatabaseException;
use Patterns\Creational\AbstractFactory\Database\DatabaseMock;
use Patterns\Creational\AbstractFactory\Spell\SpellFactoryException;
use Patterns\Creational\AbstractFactory\SpellFactory;
use src\AbstractUnitTest;

class SpellFactoryTest extends AbstractUnitTest
{
    /**
     * @dataProvider spellDataProvider
     * @param int $id
     * @param $data
     * @throws DatabaseException
     * @throws SpellFactoryException
     */
    public function testSpellFactoryCreateSpell(int $id, $data): void
    {
        $database = new DatabaseMock();
        $factory = new SpellFactory($database);
        $spell = $factory->create($id);

        self::assertEquals($data['id'], $spell->getId());
        self::assertEquals($data['type'], $spell->getType());
        self::assertEquals($data['name'], $spell->getName());
        self::assertEquals($data['power'], $spell->getPower());
    }

    /**
     * @throws DatabaseException
     * @throws SpellFactoryException
     */
    public function testSpellFactoryUndefinedSpell(): void
    {
        $id = 5;
        $database = new DatabaseMock();
        $factory = new SpellFactory($database);

        $this->expectException(DatabaseException::class);
        $this->expectExceptionMessage(DatabaseException::UNDEFINED_SPELL);
        $factory->create($id);
    }

    /**
     * @throws DatabaseException
     * @throws SpellFactoryException
     */
    public function testSpellFactoryUndefinedType(): void
    {
        $id = 3;
        $database = new DatabaseMock();
        $factory = new SpellFactory($database);

        $this->expectException(SpellFactoryException::class);
        $this->expectExceptionMessage(SpellFactoryException::UNDEFINED_TYPE);
        $factory->create($id);
    }

    /**
     * @return array[]
     */
    public function spellDataProvider(): array
    {
        return [
            [
                1,
                [
                    'id'    => 1,
                    'type'  => 1,
                    'name'  => 'Легкое лечение',
                    'power' => 30,
                ],
            ],
            [
                2,
                [
                    'id'    => 2,
                    'type'  => 2,
                    'name'  => 'Огненный шар',
                    'power' => 50,
                ]
            ],
        ];
    }
}
