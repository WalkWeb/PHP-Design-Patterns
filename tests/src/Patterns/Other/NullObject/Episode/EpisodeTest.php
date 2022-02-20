<?php

declare(strict_types=1);

namespace Tests\Other\NullObject\Episode;

use Patterns\Other\NullObject\Character\Action\GoldAction;
use Patterns\Other\NullObject\Episode\Episode;
use src\AbstractUnitTest;

class EpisodeTest extends AbstractUnitTest
{
    public function testEpisodeCreate(): void
    {
        $action = new GoldAction(10);
        $description = 'Gold episode description';

        $episode = new Episode($description, $action);

        self::assertEquals($action, $episode->getAction());
        self::assertEquals($description, $episode->getDescription());
    }
}
