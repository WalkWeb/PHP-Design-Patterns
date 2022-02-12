<?php

declare(strict_types=1);

namespace Tests\Other\NullObject\Character\Action;

use Patterns\Other\NullObject\Character\Action\NullAction;
use PHPUnit\Framework\TestCase;

class NullActionTest extends TestCase
{
    public function testNullActionCreate(): void
    {
        $action = new NullAction();

        self::assertEquals(NullAction::NULL_HANDLER, $action->handleMethod());
        self::assertEquals(0, $action->getPower());
    }
}
