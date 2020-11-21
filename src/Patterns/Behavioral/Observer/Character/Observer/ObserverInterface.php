<?php

namespace Patterns\Behavioral\Observer\Character\Observer;

use Patterns\Behavioral\Observer\Character\CharacterInterface;

/**
 * Используем свой интерфейс наблюдателя, потому что использование SplObserver принудит нас использовать исключительно
 * SplSubject, а мы хотим делать привязку к своим интерфейсам
 *
 * @package ObserverExample
 */
interface ObserverInterface
{
    public function update(CharacterInterface $subject): void;
}
