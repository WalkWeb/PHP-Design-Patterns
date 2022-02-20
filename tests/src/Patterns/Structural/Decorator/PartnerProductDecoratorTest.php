<?php

declare(strict_types=1);

namespace Tests\Structural\Decorator;

use Patterns\Structural\Decorator\PartnerProductDecorator;
use Patterns\Structural\Decorator\Product;
use src\AbstractUnitTest;

class PartnerProductDecoratorTest extends AbstractUnitTest
{
    public function testPartnerProductDecoratorCreate(): void
    {
        $buyPrice = 100;
        $sellPrice = 200;

        $partnerBuyModifier = 10;
        $partnerSellModifier = -20;

        $product = new Product($buyPrice, $sellPrice);
        $partnerProduct = new PartnerProductDecorator($product, $partnerBuyModifier, $partnerSellModifier);

        self::assertEquals((int)round($buyPrice * (1 + $partnerBuyModifier/100)), $partnerProduct->getBuyPrice());
        self::assertEquals((int)round($sellPrice * (1 + $partnerSellModifier/100)), $partnerProduct->getSellPrice());
    }
}
