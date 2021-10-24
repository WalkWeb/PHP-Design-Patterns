<?php

namespace Patterns\Structural\Adapter\ShopModule;

class Shop
{
    /**
     * @var ProductInterface[]
     */
    private $products;

    public function addProduct(ProductInterface $product): void
    {
        $this->products[] = $product;
    }

    public function getProducts(): array
    {
        return $this->products;
    }
}
