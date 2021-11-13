<?php

declare(strict_types=1);

namespace Tests\Structural\Adapter;

use Patterns\Structural\Adapter\CarModule\Car;
use Patterns\Structural\Adapter\ProductAdapter;
use Patterns\Structural\Adapter\ShopModule\Shop;
use PHPUnit\Framework\TestCase;

class ProductAdapterTest extends TestCase
{
    public function testProductAdapter(): void
    {
        $name = 'Запорожец';
        $description = 'Дешево и сердито';
        $price = 1000;

        // Вначале создаем объекты из разных модулей, которые необходимо объединить в работе
        $shop = new Shop();
        $car = new Car($name, $description, $price);

        // Оборачиваем car адаптером
        $productAdapter = new ProductAdapter($car);

        // Убеждаемся, что $car и $productAdapter возвращают одни и те же данные - т.е. их функциональность одинакова
        self::assertEquals($car->name(), $productAdapter->getName());
        self::assertEquals($car->description(), $productAdapter->getDescription());
        self::assertEquals($car->price(), $productAdapter->getPrice());

        // Теперь мы можем добавить $car как продукт в $shop и работать с ним
        $shop->addProduct($productAdapter);

        self::assertEquals([$productAdapter], $shop->getProducts());
    }
}
