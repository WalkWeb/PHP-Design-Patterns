<?php

namespace Patterns\Structural\Decorator;

/**
 * Декоратор используется для добавления определенному объекту функциональность, таким образом, чтобы:
 * 1. Не вносить изменений в исходный объект
 * 2. Принцип работы с объектом не изменялся
 *
 * Названия методов декоратора обязательно совпадают с названиями методов исходного объекта.
 * Для внешнего пользователя не должно быть разницы, работает он с изначальным объектом или декоратором
 *
 * Пример использования:
 *
 * Допустим, у нас есть какой-то объект продукта, у которого есть цена покупки и продажи.
 * И есть партнеры, для которых цена может некоторым образом изменяться
 * Чтобы не вносить изменения в изначальный объект продукта, и в тоже время, получить такой объект продукта, который бы
 * уже учитывал модификаторы цены партнера - созданим декоратор PartnerProductDecorator
 *
 * $product = new Product(100, 200);
 * $partnerProduct = new PartnerProductDecorator($product, 10, -20);
 *
 * var_dump($partnerProduct->getBuyPrice());  // 110
 * var_dump($partnerProduct->getSellPrice()); // 160
 *
 * @package Patterns\Decorator
 */
class PartnerProductDecorator
{
    /** @var Product */
    private $product;

    /** @var int - Модификатор изменяющий стоимость покупки продукта для партнера, в % */
    private $buyModifier;

    /** @var int - Модификатор изменяющий стоимость продажи продукта для партнера, в % */
    private $sellModifier;

    /**
     * PartnerProductDecorator constructor.
     * @param Product $product
     * @param int $buyModifier
     * @param int $sellModifier
     */
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
