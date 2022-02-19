<?php

declare(strict_types=1);

namespace Tests\Structural\Proxy\Order\Log;

use DateTime;
use Patterns\Structural\Proxy\Order\Log\CreateOrderLog;
use src\AbstractUnitTest;

class CreateOrderLogTest extends AbstractUnitTest
{
    public function testCreateOrderLogCreate(): void
    {
        $request = '{"data":"example request"}';
        $response = '{"data":"example response"}';
        $error = 'example error';

        $log = new CreateOrderLog($request);

        self::assertEquals($request, $log->getRequest());
        self::assertEquals(
            (new DateTime())->format(self::DATE_FORMAT),
            $log->getCreatedAt()->format(self::DATE_FORMAT)
        );
        self::assertFalse($log->isSuccess());

        $log->setSuccess(true);

        self::assertTrue($log->isSuccess());

        $log->setResponse($response);
        $log->setError($error);

        self::assertEquals($response, $log->getResponse());
        self::assertEquals($error, $log->getError());
    }
}
