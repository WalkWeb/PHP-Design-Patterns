<?php

declare(strict_types=1);

namespace Patterns\Strategy\Unit\Strategy;

interface StrategyInterface
{
    public const MEETING_ENEMY_FIGHT  = 'При встрече с врагом вступаю в бой';
    public const MEETING_ENEMY_ESCAPE = 'При встрече с врагом убегаю';

    public function atMeetingEnemy(): string;
}
