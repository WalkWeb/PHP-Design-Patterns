<?php

declare(strict_types=1);

namespace Tests\Other\NullObject\Character\Action;

use Patterns\Other\NullObject\Character\Action\TrapAction;
use PHPUnit\Framework\TestCase;

class TrapActionTest extends TestCase
{
    public function testTrapActionCreate(): void
    {
        $action = new TrapAction($power = 50);

        self::assertEquals(TrapAction::TRAP_HANDLER, $action->handleMethod());
        self::assertEquals($power, $action->getPower());
    }
}
