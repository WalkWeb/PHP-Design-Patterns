<?php

declare(strict_types=1);

namespace Tests\Behavioral\Observer;

use Patterns\Behavioral\Observer\Character\Character;
use Patterns\Behavioral\Observer\Character\Observer\Achievement\AchievementObserver;
use Patterns\Behavioral\Observer\Character\Observer\Achievement\AchievementObserverInterface;
use Patterns\Behavioral\Observer\Character\Observer\Notification\NotificationObserver;
use Patterns\Behavioral\Observer\Character\Observer\Notification\NotificationObserverInterface;
use PHPUnit\Framework\TestCase;

class CharacterObserversTest extends TestCase
{
    public function testAchievementObserver(): void
    {
        $level = 4;
        $character = new Character($level);
        $character->attach(new AchievementObserver());

        self::assertCount(0 , $character->getAchievements());
        $character->levelUp();
        self::assertCount(1, $character->getAchievements());

        foreach ($character->getAchievements() as $achievement) {
            self::assertEquals(AchievementObserverInterface::ACHIEVEMENT_NAME, $achievement);
        }

        // Проверяем, что последующие изменения уровня не приводят к добавлению достижений
        for ($i = 0; $i < 5; $i++) {
            $character->levelUp();
            self::assertCount(1, $character->getAchievements());
        }
    }

    public function testNotificationObserver(): void
    {
        $level = 9;
        $character = new Character($level);
        $character->attach(new NotificationObserver());

        self::assertCount(0 , $character->getNotifications());
        $character->levelUp();
        self::assertCount(1, $character->getNotifications());

        foreach ($character->getNotifications() as $notification) {
            self::assertEquals(NotificationObserverInterface::NOTIFICATION_NAME, $notification);
        }

        // Проверяем, что последующие изменения уровня не приводят к добавлению уведомлений
        for ($i = 0; $i < 5; $i++) {
            $character->levelUp();
            self::assertCount(1, $character->getNotifications());
        }
    }
}
