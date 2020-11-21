<?php

namespace Tests\Creational\SimpleFactory;

use PHPUnit\Framework\TestCase;
use Patterns\Creational\SimpleFactory\Request;
use Patterns\Creational\SimpleFactory\SimpleRequestFactory;

class SimpleRequestFactoryTest extends TestCase
{
    /**
     * Проверяем создание объекта Request
     */
    public function testCreate(): void
    {
        $factory = new SimpleRequestFactory();
        $request = $factory->fromGlobals();

        self::assertInstanceOf(Request::class, $request);
    }
}
