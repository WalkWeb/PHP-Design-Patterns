<?php

namespace Patterns\Structural\Adapter;

use Patterns\Structural\Adapter\CarModule\CarInterface;
use Patterns\Structural\Adapter\ShopModule\ProductInterface;

class ProductAdapter implements ProductInterface
{
    private $product;

    public function __construct(CarInterface $car)
    {
        $this->product = $car;
    }

    public function getName(): string
    {
        return $this->product->name();
    }

    public function getPrice(): int
    {
        return $this->product->price();
    }
}
