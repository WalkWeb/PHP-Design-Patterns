<?php

declare(strict_types=1);

namespace Patterns\Structural\Proxy\Order\Create;

use Exception;
use JsonException;
use Patterns\Structural\Proxy\Order\Order;
use Patterns\Structural\Proxy\Order\OrderException;
use Patterns\Structural\Proxy\Order\OrderInterface;

class CreateOrderComponent
{
    /**
     * Так как у нас нет базы, а в тестах нужно получить созданный объект, то добавляется такой костыль, специально для
     * тестов, специально для такого упрощенного примера без базы
     *
     * @var OrderInterface
     */
    private $order;

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

    public function getOrder(): OrderInterface
    {
        return $this->order;
    }

    /**
     * @param string $json
     * @return array
     * @throws Exception
     */
    private function jsonDecode(string $json): array
    {
        try {
            return json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        } catch (Exception $e) {
            throw new OrderException(OrderException::INVALID_JSON);
        }
    }

    /**
     * @param array $data
     * @return string
     * @throws JsonException
     */
    private function jsonEncode(array $data): string
    {
        return json_encode($data, JSON_THROW_ON_ERROR);
    }

    private function saveOrder(OrderInterface $order): void
    {
        // Сохранение заказа в базу, для простоты примера не делается
        // а добавляется как свойство компонента, чтобы его можно было получить и проверить в тестах
        $this->order = $order;
    }
}
