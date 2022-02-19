<?php

declare(strict_types=1);

namespace Patterns\Structural\Proxy\Order\Proxy;

use Exception;
use Patterns\Structural\Proxy\Order\Create\CreateOrderComponent;
use Patterns\Structural\Proxy\Order\Log\CreateOrderLog;
use Patterns\Structural\Proxy\Order\Log\LogInterface;
use Patterns\Structural\Proxy\Order\OrderException;
use Patterns\Structural\Proxy\Order\OrderInterface;

class CreateOrderLoggerProxy
{
    /**
     * @var CreateOrderComponent
     */
    private $createOrderComponent;

    /**
     * Так как в этом простом примере лог не сохраняется в базе, а для тестов его нужно как-то получить - добавляем
     * такой костыль. В реальном проекте он не нужен - в тестах созданный лог получаем из базы
     *
     * @var LogInterface
     */
    private $log;

    public function __construct(CreateOrderComponent $createOrderComponent)
    {
        $this->createOrderComponent = $createOrderComponent;
    }

    /**
     * Логирующая обертка над CreateOrderComponent::handle()
     *
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

    /**
     * @return OrderInterface
     */
    public function getOrder(): OrderInterface
    {
        return $this->createOrderComponent->getOrder();
    }

    /**
     * @return LogInterface
     */
    public function getLog(): LogInterface
    {
        return $this->log;
    }

    private function saveLog(CreateOrderLog $log): void
    {
        // Сохранение лога в базу, или отправка его в сервис для хранения, для простоты примера не делается
        // а добавляется как свойство Proxy, чтобы его можно было получить и проверить в тестах

        $this->log = $log;
    }
}
