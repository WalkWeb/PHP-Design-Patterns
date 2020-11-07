<?php

namespace Tests\StaticFactory;

use PHPUnit\Framework\TestCase;
use Patterns\SimpleFactory\Request;
use Patterns\StaticFactory\StaticRequestFactory;

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
