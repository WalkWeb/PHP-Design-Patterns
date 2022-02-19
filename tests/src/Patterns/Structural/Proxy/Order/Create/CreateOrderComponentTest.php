<?php

declare(strict_types=1);

namespace Tests\Structural\Proxy\Order\Create;

use Exception;
use Patterns\Structural\Proxy\Order\Create\CreateOrderComponent;
use Patterns\Structural\Proxy\Order\OrderException;
use src\AbstractUnitTest;

class CreateOrderComponentTest extends AbstractUnitTest
{
    /**
     * Тест на успешное создание заказа
     *
     * @dataProvider successDataProvider
     * @param array $data
     * @throws Exception
     */
    public function testCreateOrderComponentHandleSuccess(array $data): void
    {
        $component = new CreateOrderComponent();
        $json = $this->jsonEncode($data);

        $response = $component->handle($json);

        self::assertIsString($this->jsonDecode($response)['order_id']);

        $order = $component->getOrder();

        self::assertEquals($data['user'], $order->getUser());
        self::assertEquals($data['positions'], $order->getPositions());
    }

    /**
     * Тест на ситуацию, когда передан невалидный json с данными по новому заказу
     */
    public function testCreateOrderComponentHandleFail(): void
    {
        $component = new CreateOrderComponent();
        $json = 'invalid_json';

        try {
            $component->handle($json);
        } catch (Exception $e) {
            self::assertEquals(OrderException::CREATE_ERROR . ': ' . OrderException::INVALID_JSON, $e->getMessage());
        }
    }

    /**
     * @return array
     */
    public function successDataProvider(): array
    {
        return [
            [
                [
                    'user' => 'User #1',
                    'positions' => [
                        'position #1',
                        'position #2',
                        'position #3',
                    ],
                ],
                [
                    'user' => 'User #2',
                    'positions' => [
                        'position',
                    ],
                ],
            ],
        ];
    }
}
