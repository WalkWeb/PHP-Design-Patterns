<?php

declare(strict_types=1);

namespace Patterns\Behavioral\State\Application\State;

class ApplicationStateClosed extends AbstractApplicationState
{
    public function auctionNew(): string
    {
        $this->context->transitionTo(new ApplicationStateNew($this->context));
        return self::AUCTION_NEW;
    }
}
