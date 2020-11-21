<?php

declare(strict_types=1);

namespace Patterns\Behavioral\Strategy\Unit\Strategy;

class CowardStrategy implements StrategyInterface
{
    public function atMeetingEnemy(): string
    {
        return self::MEETING_ENEMY_ESCAPE;
    }
}
