<?php

namespace Patterns\Structural\Facade;

class Shop
{
    /**
     * Представим, что этот метод ищет ближайший книжный магазин, на основании данных пользователя, где он сможет купить
     * рекомендуемую книгу
     *
     * @return string
     */
    public function getNearestShop(): string
    {
        return 'Amazon';
    }
}
