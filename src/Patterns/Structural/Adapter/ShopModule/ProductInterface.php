<?php

namespace Patterns\Structural\Adapter\ShopModule;

interface ProductInterface
{
    public function getName(): string;
    public function getPrice(): int;
}
