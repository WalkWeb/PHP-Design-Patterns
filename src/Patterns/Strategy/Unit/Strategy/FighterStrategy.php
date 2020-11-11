<?php

declare(strict_types=1);

namespace Patterns\Strategy\Unit\Strategy;

class FighterStrategy implements StrategyInterface
{
    public function atMeetingEnemy(): string
    {
        return self::MEETING_ENEMY_FIGHT;
    }
}
