<?php

declare(strict_types=1);

namespace Tests\Other\NullObject\Character\Action;

use Patterns\Other\NullObject\Character\Action\NullAction;
use src\AbstractUnitTest;

class NullActionTest extends AbstractUnitTest
{
    public function testNullActionCreate(): void
    {
        $action = new NullAction();

        self::assertEquals(NullAction::NULL_HANDLER, $action->handleMethod());
        self::assertEquals(0, $action->getPower());
    }
}
