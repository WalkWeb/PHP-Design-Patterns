<?php

declare(strict_types=1);

namespace Tests\Other\NullObject\Character;

use Patterns\Other\NullObject\Character\Action\GoldAction;
use Patterns\Other\NullObject\Character\Action\NullAction;
use Patterns\Other\NullObject\Character\Action\TrapAction;
use Patterns\Other\NullObject\Character\Character;
use Patterns\Other\NullObject\Character\CharacterException;
use Patterns\Other\NullObject\Episode\Episode;
use PHPUnit\Framework\TestCase;

class CharacterTest extends TestCase
{
    /**
     * @throws CharacterException
     */
    public function testTrapEpisode(): void
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
    public function testGoldEpisode(): void
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
    public function testInfoEpisode(): void
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
}
