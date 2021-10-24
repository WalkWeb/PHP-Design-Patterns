
# Адаптер (Adapter)

Данный паттерн предназначен для замены интерфейса объекта, не меняя его функциональности.

## Пример

Допустим, у нас есть два независимых модуля, и нам нужно передать для работы объект из одного модуля, в другой. Но
как это сделать, если интерфейсы разные и, к примеру, править код ни первого, ни второго модуля нельзя?

Данную проблему как раз решает паттерн адаптер - это новый класс, который не связан никак с первым, ни со вторым 
модулем, который оборачивает нужный объект, тем самым подменяя его интерфейс. Хотя сам функционал объекта никак не 
меняется.

```php
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
```

После чего мы спокойно можем передавать для работы объект из `CarModule` в `ShopModule` и, во-первых, все будет 
работать, а во-вторых - никаких изменений ни в один из модулей не было внесено.

## Отличие от декоратора

Адаптер - меняет интерфейс не меняя функциональность, [декоратор](https://github.com/WalkWeb/PHP-Design-Patterns/tree/master/src/Patterns/Structural/Decorator) 
меняет функциональность, не меняя интерфейс.
