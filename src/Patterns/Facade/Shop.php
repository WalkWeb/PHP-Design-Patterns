<?php

namespace Patterns\Facade;

class Shop
{
    /**
     * Представим, что этот метод ищет ближайший к пользователю книжный магазин, где он сможет купить нужную ему книгу
     *
     * @return string
     */
    public function getNearestShop(): string
    {
        return 'Amazon';
    }
}
