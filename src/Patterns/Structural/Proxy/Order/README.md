
# Прокси (Proxy)

Данный паттерн предназначен для добавления функционала объекту, не меняя его.

## Пример

Представим, что нам необходимо реализовать механику создания заказа в интернет магазине. И самое главное в таком 
критичном функционале – покрыть его логами. Потому что пользователь может ошибиться, заказать не то, что хотел, а 
обвинять в неправильной работе магазин. Или просто сказать, что его заказа потерялся. Без логов разобраться в таких 
ситуациях будет невозможно.

Механику создания заказа мы реализуем в отдельном классе `CreateOrderComponent`:

```php
class CreateOrderComponent
{
    /**
     * Принимает json с данными по созданию заказа, создает новый заказ и возвращает id созданного заказа
     *
     * @param string $request
     * @return string
     * @throws OrderException
     */
    public function handle(string $request): string
    {
        try {
            $data = $this->jsonDecode($request);

            // Валидация данных, для простоты примера не делается

            $order = new Order($data['user'], $data['positions']);

            $this->saveOrder($order);

            return $this->jsonEncode([
                'order_id' => $order->getId(),
            ]);

        } catch (Exception $e) {
            throw new OrderException(OrderException::CREATE_ERROR . ': ' . $e->getMessage());
        }
    }

    // ...
}
```

И далее необходимо добавить логирование. Его можно сделать его в этом же классе `CreateOrderComponent`, но, во-первых, 
это усложнит его работу, во вторых сделает его супер-объектом: когда какой-то класс делает сразу несколько задач.

Чтобы написать удобный код в поддержке и расширении, вынесем механику логирования в отдельный proxy-класс 
`CreateOrderLoggerProxy`:

```php
class CreateOrderLoggerProxy
{
    /**
     * @var CreateOrderComponent
     */
    private $createOrderComponent;

    public function __construct(CreateOrderComponent $createOrderComponent)
    {
        $this->createOrderComponent = $createOrderComponent;
    }

    /**
     * @param string $request
     * @return string
     * @throws OrderException
     */
    public function handle(string $request): string
    {
        $log = new CreateOrderLog($request);

        try {
            $response = $this->createOrderComponent->handle($request);
            $log->setResponse($response);
            $log->setSuccess(true);
            return $response;

        } catch (Exception $e) {
            $log->setError($e->getMessage());
            throw $e;
        } finally {
            $this->saveLog($log);
        }
    }
    
    // ...
}
``` 

Который «оборачивает» исходный класс `CreateOrderComponent` и добавляет механику логирования его работы.

При этом, использование исходного класса, и proxy-класса будет идентичным:

```php
// Обычное создание заказа
$component = new CreateOrderComponent();
$response = $component->handle($json);

// Создание заказа + логирование
$proxy = new CreateOrderLoggerProxy(new CreateOrderComponent());
$response = $proxy->handle($json);
``` 

При этом механика создания заказа, и механика логирования может усложняться и обрастать новым функционалом независимо
друг от друга. Более того, можно сделать единый интерфейс для всех компонентов, и сделать такой же единый proxy, с 
помощью которого можно будет логировать любой процесс: создание заказа, отмена заказа, изменение заказа и прочее.
