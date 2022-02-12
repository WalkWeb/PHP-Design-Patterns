<?php

declare(strict_types=1);

namespace Tests\Other\NullObject\Character\Action;

use Patterns\Other\NullObject\Character\Action\GoldAction;
use PHPUnit\Framework\TestCase;

class GoldActionTest extends TestCase
{
    public function testGoldActionCreate(): void
    {
        $action = new GoldAction($power = 50);

        self::assertEquals(GoldAction::GOLD_HANDLER, $action->handleMethod());
        self::assertEquals($power, $action->getPower());
    }
}
