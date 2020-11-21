<?php

declare(strict_types=1);

namespace Patterns\Behavioral\State\Application\State;

class ApplicationStateStart extends AbstractApplicationState
{
    public function auctionEnd(): string
    {
        $this->context->transitionTo(new ApplicationStateEnd($this->context));
        return self::AUCTION_END;
    }

    public function auctionClosed(): string
    {
        $this->context->transitionTo(new ApplicationStateClosed($this->context));
        return self::AUCTION_CLOSED;
    }

    public function singUp(): string
    {
        return self::SING_UP_START;
    }
}
