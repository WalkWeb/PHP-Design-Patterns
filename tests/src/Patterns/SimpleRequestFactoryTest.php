<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Patterns\SimpleFactory\Request;
use Patterns\SimpleFactory\SimpleRequestFactory;

class SimpleRequestFactoryTest extends TestCase
{
    /**
     * Проверяем создание объекта Request
     */
    public function testCreate(): void
    {
        $factory = new SimpleRequestFactory();
        $request = $factory->fromGlobals();

        $this->assertInstanceOf(Request::class, $request);
    }
}
