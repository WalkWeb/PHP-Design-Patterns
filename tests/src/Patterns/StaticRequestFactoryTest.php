<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Patterns\SimpleFactory\Request;
use Patterns\StaticRequestFactory\StaticRequestFactory;

class StaticRequestFactoryTest extends TestCase
{
    /**
     * Проверяем создание объекта Request
     */
    public function testCreate(): void
    {
        $request = StaticRequestFactory::fromGlobals();

        $this->assertInstanceOf(Request::class, $request);
    }
}
