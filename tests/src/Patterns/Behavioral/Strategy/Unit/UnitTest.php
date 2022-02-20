<?php

declare(strict_types=1);

namespace Tests\Behavioral\Strategy\Unit;

use Patterns\Behavioral\Strategy\Unit\Strategy\CowardStrategy;
use Patterns\Behavioral\Strategy\Unit\Strategy\FighterStrategy;
use Patterns\Behavioral\Strategy\Unit\Strategy\StrategyInterface;
use Patterns\Behavioral\Strategy\Unit\Unit;
use src\AbstractUnitTest;

class UnitTest extends AbstractUnitTest
{
    /**
     * @dataProvider unitStrategyProvider
     * @param string $name
     * @param string $strategyClass
     * @param string $message
     */
    public function testUnitStrategyCreate(string $name, string $strategyClass, string $message): void
    {
        $strategy = new $strategyClass();
        $unit = new Unit($name, $strategy);
        self::assertEquals($name, $unit->getName());
        self::assertEquals($message, $unit->atMeetingEnemy());
    }

    /**
     * @return array
     */
    public function unitStrategyProvider(): array
    {
        return [
            [
                'Воин',
                FighterStrategy::class,
                StrategyInterface::MEETING_ENEMY_FIGHT,
            ],
            [
                'Трус',
                CowardStrategy::class,
                StrategyInterface::MEETING_ENEMY_ESCAPE,
            ],
        ];
    }
}
