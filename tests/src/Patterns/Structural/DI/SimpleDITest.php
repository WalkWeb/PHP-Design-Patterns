<?php

declare(strict_types=1);

namespace Tests\Structural\DI;

use Patterns\Structural\DI\SimpleDI;
use PHPUnit\Framework\TestCase;

class SimpleDITest extends TestCase
{
    public function testSimpleDICreate(): void
    {
        $name = 'Simple Dependency Injection';

        $di = new SimpleDI($name);

        self::assertEquals($name, $di->getName());
    }
}
