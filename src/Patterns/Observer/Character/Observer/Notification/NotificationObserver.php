<?php

declare(strict_types=1);

namespace Patterns\Observer\Character\Observer\Notification;

use Patterns\Observer\Character\CharacterInterface;

class NotificationObserver implements NotificationObserverInterface
{
    public function update(CharacterInterface $character): void
    {
        if ($character->getLevel() === self::NOTIFICATION_LEVEL) {
            $character->addNotification(self::NOTIFICATION_NAME);
        }
    }
}
