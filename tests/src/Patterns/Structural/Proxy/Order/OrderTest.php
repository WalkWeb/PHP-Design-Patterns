<?php

declare(strict_types=1);

namespace Tests\Structural\Proxy\Order;

use Patterns\Structural\Proxy\Order\Order;
use src\AbstractUnitTest;

class OrderTest extends AbstractUnitTest
{
    public function testOrderCreate(): void
    {
        $user = 'User';
        $positions = ['position #1', 'position #2'];

        $order = new Order($user, $positions);

        self::assertEquals($user, $order->getUser());
        self::assertEquals($positions, $order->getPositions());
        self::assertIsString($order->getId());
    }
}
