
# Декоратор (Decorator)

Декоратор используется для добавления определенному объекту функциональность, таким образом, чтобы:

1. Не вносить изменений в исходный объект
2. Принцип работы с объектом-оберткой не отличался от работы с исходным объектом

Названия методов декоратора обязательно совпадают с названиями методов исходного объекта - интерфейс не должен меняться.
Для внешнего пользователя не должно быть разницы, работает он с изначальным объектом или декоратором.

## Пример

Допустим, у нас есть какой-то объект продукта, у которого есть цена покупки и продажи:

```php
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
```

И есть партнеры, для которых цена может некоторым образом изменяться. 

Чтобы не вносить изменения в изначальный объект продукта, и в тоже время, получить нужный функционал для партнеров - 
создадим объект-обертку декоратор PartnerProductDecorator:

```php
use Patterns\Structural\Decorator\Product;

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
```

В итоге получаем объект, взаимодействие с которым будет такое же, как и с обычным продуктом, но в дополнение получен 
нужный функционал цен для партнеров.

```php
use Patterns\Structural\Decorator\Product;
use Patterns\Structural\Decorator\PartnerProductDecorator;

$product = new Product(100, 200);
$partnerProduct = new PartnerProductDecorator($product, 10, -20);

var_dump($partnerProduct->getBuyPrice());  // 110
var_dump($partnerProduct->getSellPrice()); // 160
```

## Отличие от адаптера

Декоратор изменяет принцип работы объекта, не меняя его интерфейса, а [адаптер](https://github.com/WalkWeb/PHP-Design-Patterns/tree/master/src/Patterns/Structural/Adapter) 
не меняя работу объекта изменяет интерфейс.
