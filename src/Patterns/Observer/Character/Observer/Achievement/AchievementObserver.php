<?php

declare(strict_types=1);

namespace Patterns\Observer\Character\Observer\Achievement;

use Patterns\Observer\Character\CharacterInterface;

class AchievementObserver implements AchievementObserverInterface
{
    public function update(CharacterInterface $character): void
    {
        if ($character->getLevel() === self::ACHIEVEMENT_LEVEL) {
            $character->addAchievement(self::ACHIEVEMENT_NAME);
        }
    }
}
