<?php

namespace Patterns\Structural\Decorator;

class PartnerProductDecorator
{
    /** @var Product */
    private $product;

    /** @var int - Модификатор изменяющий стоимость покупки продукта для партнера, в % */
    private $buyModifier;

    /** @var int - Модификатор изменяющий стоимость продажи продукта для партнера, в % */
    private $sellModifier;

    public function __construct(Product $product, int $buyModifier, int $sellModifier)
    {
        $this->product = $product;
        $this->buyModifier = $buyModifier;
        $this->sellModifier = $sellModifier;
    }

    /**
     * Возвращает цену покупки продукта с учетом модификатора покупки партнера
     *
     * @return int
     */
    public function getBuyPrice(): int
    {
        return (int)round($this->product->getBuyPrice() * (1 + $this->buyModifier/100));
    }

    /**
     * Возвращает цену продажи продукта с учетом модификатора продажи партнера
     *
     * @return int
     */
    public function getSellPrice(): int
    {
        return (int)round($this->product->getSellPrice() * (1 + $this->sellModifier/100));
    }
}
