<?php

declare(strict_types=1);

namespace Tests\Other\NullObject\Character;

use Patterns\Other\NullObject\Character\Action\GoldAction;
use Patterns\Other\NullObject\Character\Action\NullAction;
use Patterns\Other\NullObject\Character\Action\TrapAction;
use Patterns\Other\NullObject\Character\Character;
use Patterns\Other\NullObject\Character\CharacterException;
use Patterns\Other\NullObject\Episode\Episode;
use src\AbstractUnitTest;

class CharacterTest extends AbstractUnitTest
{
    /**
     * @throws CharacterException
     */
    public function testCharacterHandleTrapEpisode(): void
    {
        $hp = 100;
        $gold = 0;
        $description = 'Вы наткнулись на ловушку и повредили ногу';
        $power = 35;

        $character = new Character($hp, $gold);
        $action = new TrapAction($power);
        $episode = new Episode($description, $action);

        $character->handleAction($episode->getAction());

        self::assertEquals($hp - $power, $character->getHp());
    }

    /**
     * @throws CharacterException
     */
    public function testCharacterHandleGoldEpisode(): void
    {
        $hp = 100;
        $gold = 0;
        $description = 'Вы нашли немного золота';
        $power = 15;

        $character = new Character($hp, $gold);
        $action = new GoldAction($power);
        $episode = new Episode($description, $action);

        $character->handleAction($episode->getAction());

        self::assertEquals($gold + $power, $character->getGold());
    }

    /**
     * @throws CharacterException
     */
    public function testCharacterHandleInfoEpisode(): void
    {
        $hp = 100;
        $gold = 10;
        $description = 'Вы наткнулись на камень, на котором было написано: «без вариантов»';

        $character = new Character($hp, $gold);
        $action = new NullAction();
        $episode = new Episode($description, $action);

        $character->handleAction($episode->getAction());

        self::assertEquals($hp, $character->getHp());
        self::assertEquals($gold, $character->getGold());
    }

    /**
     * Проверка получения исключения при получении неизвестного метода для обработки игрового события (Action)
     *
     * @throws CharacterException
     */
    public function testCharacterUndefinedHandleMethod(): void
    {
        $hp = 100;
        $gold = 0;
        $description = 'Вы наткнулись на ловушку и повредили ногу';

        $actionMock = $this->createMock(TrapAction::class);
        $actionMock->method('handleMethod')
            ->willReturn($method = 'undefinedHandleMethod');

        $character = new Character($hp, $gold);
        $episode = new Episode($description, $actionMock);

        $this->expectException(CharacterException::class);
        $this->expectExceptionMessage(CharacterException::UNDEFINED_METHOD . ': '. $method);
        $character->handleAction($episode->getAction());
    }

    /**
     * Тест на получение очень большого урона - здоровье не должно опуститься ниже 0
     *
     * @throws CharacterException
     */
    public function testCharacterHandleOverDamageEpisode(): void
    {
        $hp = 100;
        $gold = 0;
        $description = 'Вы наткнулись на ловушку с огромным уроном';
        $power = 500;

        $character = new Character($hp, $gold);
        $action = new TrapAction($power);
        $episode = new Episode($description, $action);

        $character->handleAction($episode->getAction());

        self::assertEquals(0, $character->getHp());
    }
}
