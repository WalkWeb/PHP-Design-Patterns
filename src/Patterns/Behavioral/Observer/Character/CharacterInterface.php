<?php

namespace Patterns\Behavioral\Observer\Character;

use Patterns\Behavioral\Observer\Character\Observer\ObserverInterface;
use SplObjectStorage;

/**
 * Используем свой интерфейс, потому что использование SplSubject принудит нас использовать исключительно
 * SplObserver, а мы хотим делать привязку к своим интерфейсам
 *
 * @package ObserverExample
 */
interface CharacterInterface
{
    public function levelUp(): void;
    public function getLevel(): int;
    public function getAchievements(): array;
    public function getNotifications(): array;
    public function addAchievement(string $achievement): void;
    public function addNotification(string $notification): void;
    public function attach(ObserverInterface $observer): void;
    public function detach(ObserverInterface $observer): void;
    public function notify(): void;
    public function getObservers(): SplObjectStorage;
}
