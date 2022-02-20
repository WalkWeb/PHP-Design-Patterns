<?php

declare(strict_types=1);

namespace Tests\Structural\DI;

use Patterns\Structural\DI\SimpleDI;
use src\AbstractUnitTest;

class SimpleDITest extends AbstractUnitTest
{
    public function testSimpleDICreate(): void
    {
        $name = 'Simple Dependency Injection';

        $di = new SimpleDI($name);

        self::assertEquals($name, $di->getName());
    }
}
