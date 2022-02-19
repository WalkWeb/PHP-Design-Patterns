<?php

declare(strict_types=1);

namespace Patterns\Structural\Proxy\Order;

/**
 * Упрощенный объекта заказа, для примера
 *
 * Реальный заказ содержал бы еще, как минимум, дату оформления заказа, дату доставки и адрес доставки.
 *
 * @package Patterns\Structural\Proxy\Order
 */
interface OrderInterface
{
    /**
     * UUID заказа
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Имя пользователя сделавшего заказ. В реальном проекте мы бы хранили UUID юзера
     *
     * @return string
     */
    public function getUser(): string;

    /**
     * Массив с перечнем, в виде строк, заказанных товаров. В реальном проекте, разумеется, это был бы массив продуктов
     *
     * @return string[]
     */
    public function getPositions(): array;
}
