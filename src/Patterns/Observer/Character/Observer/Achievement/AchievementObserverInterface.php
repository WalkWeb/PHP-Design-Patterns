<?php

namespace Patterns\Observer\Character\Observer\Achievement;

use Patterns\Observer\Character\Observer\ObserverInterface;

interface AchievementObserverInterface extends ObserverInterface
{
    // Для простоты примера будем считать, что у нас только одно достижение для одного события: персонаж получил 5 lvl
    public const ACHIEVEMENT_LEVEL = 5;
    public const ACHIEVEMENT_NAME  = 'Новый герой';
}
