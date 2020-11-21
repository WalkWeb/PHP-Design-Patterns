<?php

namespace Tests\Creational\StaticFactory;

use PHPUnit\Framework\TestCase;
use Patterns\Creational\SimpleFactory\Request;
use Patterns\Creational\StaticFactory\StaticRequestFactory;

class StaticRequestFactoryTest extends TestCase
{
    /**
     * Проверяем создание объекта Request
     */
    public function testCreate(): void
    {
        $request = StaticRequestFactory::fromGlobals();

        self::assertInstanceOf(Request::class, $request);
    }
}
