<?php

declare(strict_types=1);

namespace Patterns\Observer\Character;

use Patterns\Observer\Character\Observer\ObserverInterface;
use SplObjectStorage;

class Character implements CharacterInterface
{
    /**
     * @var int
     */
    private $level;

    /**
     * @var array Достижения персонажа. Для простоты примера простой массив, с достижениями в виде строк внутри
     */
    private $achievements = [];

    /**
     * @var array Уведомления персонажа. Для простоты примера простой массив, с уведомлениями в виде строк внутри
     */
    private $notifications = [];

    /**
     * @var SplObjectStorage
     */
    private $observers;

    public function __construct(int $level, ?SplObjectStorage $observers = null)
    {
        $this->level = $level;
        $this->observers = $observers ?? new SplObjectStorage();
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function getAchievements(): array
    {
        return $this->achievements;
    }

    public function getNotifications(): array
    {
        return $this->notifications;
    }

    public function levelUp(): void
    {
        $this->level++;
        $this->notify();
    }

    public function attach(ObserverInterface $observer): void
    {
        $this->observers->attach($observer);
    }

    public function detach(ObserverInterface $observer): void
    {
        $this->observers->detach($observer);
    }

    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            /** @var $observer ObserverInterface */
            $observer->update($this);
        }
    }

    public function addAchievement(string $achievement): void
    {
        $this->achievements[] = $achievement;
    }

    public function addNotification(string $notification): void
    {
        $this->notifications[] = $notification;
    }
}
