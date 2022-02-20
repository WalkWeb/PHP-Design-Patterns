<?php

declare(strict_types=1);

namespace Tests\Other\NullObject\Character\Action;

use Patterns\Other\NullObject\Character\Action\TrapAction;
use src\AbstractUnitTest;

class TrapActionTest extends AbstractUnitTest
{
    public function testTrapActionCreate(): void
    {
        $action = new TrapAction($power = 50);

        self::assertEquals(TrapAction::TRAP_HANDLER, $action->handleMethod());
        self::assertEquals($power, $action->getPower());
    }
}
