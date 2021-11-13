<?php

namespace Patterns\Structural\Decorator;

class Product
{
    /** @var int - Цена покупки продукта */
    private $buyPrice;

    /** @var int - Цена продажи продукта */
    private $sellPrice;

    public function __construct(int $buyPrice, int $sellPrice)
    {
        $this->buyPrice = $buyPrice;
        $this->sellPrice = $sellPrice;
    }

    public function getBuyPrice(): int
    {
        return $this->buyPrice;
    }

    public function getSellPrice(): int
    {
        return $this->sellPrice;
    }
}
