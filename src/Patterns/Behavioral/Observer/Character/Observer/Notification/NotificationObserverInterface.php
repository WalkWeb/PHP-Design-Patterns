<?php

namespace Patterns\Behavioral\Observer\Character\Observer\Notification;

use Patterns\Behavioral\Observer\Character\Observer\ObserverInterface;

interface NotificationObserverInterface extends ObserverInterface
{
    // Для простоты примера будем считать, что у нас только одно уведомление для одного события: персонаж получил 10 lvl
    public const NOTIFICATION_LEVEL = 10;
    public const NOTIFICATION_NAME  = 'Поздравляем персонажа с юбилеем!';
}
