<?php

declare(strict_types=1);

namespace Tests\Behavioral\Strategy;

use Patterns\Behavioral\Strategy\Unit\Strategy\CowardStrategy;
use Patterns\Behavioral\Strategy\Unit\Strategy\FighterStrategy;
use Patterns\Behavioral\Strategy\Unit\Strategy\StrategyInterface;
use Patterns\Behavioral\Strategy\Unit\Unit;
use PHPUnit\Framework\TestCase;

class UnitStrategyTest extends TestCase
{
    /**
     * @dataProvider unitStrategyProvider
     * @param string $name
     * @param string $strategyClass
     * @param string $message
     */
    public function testUnitStrategy(string $name, string $strategyClass, string $message): void
    {
        $strategy = new $strategyClass();
        $unit = new Unit($name, $strategy);
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
