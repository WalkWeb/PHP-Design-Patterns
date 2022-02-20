<?php

declare(strict_types=1);

namespace Tests\Structural\Proxy\Order\Proxy;

use DateTime;
use Exception;
use Patterns\Structural\Proxy\Order\Create\CreateOrderComponent;
use Patterns\Structural\Proxy\Order\OrderException;
use Patterns\Structural\Proxy\Order\Proxy\CreateOrderLoggerProxy;
use src\AbstractUnitTest;

class CreateOrderLoggerProxyTest extends AbstractUnitTest
{
    /**
     * Тест на успешное создание заказа и сохранение лога
     *
     * @dataProvider successDataProvider
     * @param array $data
     * @throws Exception
     */
    public function testCreateOrderLoggerProxyHandleSuccess(array $data): void
    {
        $proxy = $this->getProxy();
        $json = $this->jsonEncode($data);

        $response = $proxy->handle($json);

        self::assertIsString($this->jsonDecode($response)['order_id']);

        $order = $proxy->getOrder();

        self::assertEquals($data['user'], $order->getUser());
        self::assertEquals($data['positions'], $order->getPositions());

        $log = $proxy->getLog();

        self::assertTrue($log->isSuccess());
        self::assertEquals($json, $log->getRequest());
        self::assertEquals($response, $log->getResponse());
        self::assertEquals('', $log->getError());
        self::assertEqualsDate(new DateTime(), $log->getCreatedAt());
    }

    /**
     * Тест на ошибку в данных на создание заказа - проверяем ошибку в логе
     */
    public function testCreateOrderLoggerProxyHandleFail(): void
    {
        $proxy = $this->getProxy();
        $json = 'invalid_json';

        try {
            $proxy->handle($json);
        } catch (Exception $e) {
            self::assertEquals(OrderException::CREATE_ERROR . ': ' . OrderException::INVALID_JSON, $e->getMessage());
        }

        $log = $proxy->getLog();

        self::assertFalse($log->isSuccess());
        self::assertEquals($json, $log->getRequest());
        self::assertEquals('', $log->getResponse());
        self::assertEquals(OrderException::CREATE_ERROR . ': ' . OrderException::INVALID_JSON, $log->getError());
        self::assertEqualsDate(new DateTime(), $log->getCreatedAt());
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

    /**
     * @return CreateOrderLoggerProxy
     */
    private function getProxy(): CreateOrderLoggerProxy
    {
        return new CreateOrderLoggerProxy(new CreateOrderComponent());
    }
}
