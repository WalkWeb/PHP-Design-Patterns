
# Мост (Bridge)

Данный паттерн предназначен для разделения логики на два независимых класса: абстракцию и реализацию. Я бы не 
пытался понять смысл паттерна через его определение, лучше перейти сразу к решаемой задаче и примеру.

## Пример

Представим себе, что нам необходимо реализовать API со сложной механикой: во-первых, данные в API должны быть разными,
в зависимости от платформы, для которой они предназначены (API/Web), во вторых, API отличается для разных клиентов.
Логику последнего в данном примере можно сделать через права доступа, но представим себе, что там что-то более сложное,
что обычными правами доступа не реализовать.

В текущей задаче нам нужно реализовать 4 различных варианта:

- User API + Web
- User API + Mobile
- Dealer API + Web
- Dealer API + Mobile

Плюс к этому, как платформы, так и группы пользователей с особенной логикой могут расширяться, и если делать это все
в одном классе, то количество методов в нем будет расти в геометрической прогрессии.

В этом случае отлично подойдет паттерн Мост, с помощью которого можно разделить абстракцию (класс, который будет
отвечать за логику клиентов) и реализацию (класс, который будет отвечать за логику платформы). Плюс к этому, каждый из
них будет расширять логику независимо друг от друга.

Перейдем к коду. Интерфейс для абстракции будет выглядеть так:

```php
interface APIServiceInterface
{
    /**
     * Возвращает данные по указанному продукту
     * 
     * @param string $id
     * @return array
     */
    public function findProduct(string $id): array;

    /**
     * Возвращает данные по всем продуктам
     * 
     * @return array
     */
    public function findAllProducts(): array;
}
```

Абстрактный класс абстракции. Класс не обязан быть абстрактным, если есть какая-то логика по умолчанию – можно 
реализовать её в нем.

```php
abstract class AbstractAPIService
{
    protected $api;

    public function __construct(TypeAPIInterface $api)
    {
        $this->api = $api;
    }

    /**
     * Возвращает данные по указанному продукту
     *
     * Название метода специально отличается от методов в API, чтобы показать, что они не должны быть одинаковыми
     *
     * @param string $id
     * @return array
     */
    abstract public function findProduct(string $id): array;

    /**
     * Возвращает данные по всем продуктам
     *
     * @return array
     */
    abstract public function findAllProducts(): array;
}
```

А так будет выглядеть конкретная реализация абстракции для клиентов типа дилера:

```php
class DealerServiceAPI extends AbstractAPIService
{
    /**
     * @param string $id
     * @return array
     * @throws ServiceAPIException
     */
    public function findProduct(string $id): array
    {
        throw new ServiceAPIException(ServiceAPIException::FORBIDDEN, 404);
    }

    /**
     * @return array
     */
    public function findAllProducts(): array
    {
        return [
            'meta' => $this->api->getMeta(),
            'data' => $this->api->getProducts()
        ];
    }
}
```

Теперь перейдем к реализации API на примере Web:

```php
interface TypeAPIInterface
{
    /**
     * Возвращает данные по указанному продукту
     *
     * @param string $id
     * @return array
     */
    public function getProduct(string $id): array;

    /**
     * Возвращает данные по всем продуктам
     *
     * @return array
     */
    public function getProducts(): array;

    /**
     * Возвращает описание API
     *
     * @return array
     */
    public function getMeta(): array;
}

class WebAPI implements TypeAPIInterface
{
    /**
     * Возвращает данные по указанному продукту, в нужном формате для web-фронта
     *
     * @param string $id
     * @return string[][]
     */
    public function getProduct(string $id): array
    {
        // Представим, что здесь есть логика получения данных по продукты из базы, по его id

        return [
            'id'   => 'e3c9b52c-c6ed-48ad-a275-aa797892f912',
            'name' => 'Product #1',
        ];
    }

    public function getProducts(): array
    {
        // Представим, что здесь есть логика получения продуктов из базы

        return [
            [
                'id'   => 'e3c9b52c-c6ed-48ad-a275-aa797892f912',
                'name' => 'Product #1',
            ],
            [
                'id'   => 'f2dc1fb4-85b2-4b5d-bac3-1d992e282557',
                'name' => 'Product #2',
            ],
            [
                'id'   => '70f7cdad-8629-49bf-8c02-028376c20889',
                'name' => 'Product #3',
            ],
        ];
    }

    public function getMeta(): array
    {
        return [
            'version' => '1.0 web',
        ];
    }
}
```

И примеры использования. Посмотреть их работу конкретнее можно в тестах:

```php
// Dealer + Web API
$dealerServiceAPI = new DealerServiceAPI(new WebAPI());
$dealerServiceAPI->findProduct('id'); // Exception

// Dealer + Mobile API
$dealerServiceAPI = new DealerServiceAPI(new MobileAPI());
$dealerServiceAPI->findProduct('id'); // Exception

// User + Web API
$userServiceAPI = new UserServiceAPI(new WebAPI());
$userServiceAPI->findProduct('id');

// User + Mobile API
$userServiceAPI = new UserServiceAPI(new MobileAPI());
$userServiceAPI->findProduct('id');
```

Принцип паттерна Мост – это разделение логики на два связанных, но в тоже время независимо расширяющихся друг от друга
класса, или, если точнее группы классов.
