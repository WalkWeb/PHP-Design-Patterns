<?php

declare(strict_types=1);

namespace Patterns\Behavioral\State\Application\State;

class ApplicationStateNew extends AbstractApplicationState
{
    public function auctionStart(): string
    {
        $this->context->transitionTo(new ApplicationStateStart($this->context));
        return self::AUCTION_START;
    }

    public function auctionClosed(): string
    {
        $this->context->transitionTo(new ApplicationStateClosed($this->context));
        return self::AUCTION_CLOSED;
    }

    public function singUp(): string
    {
        return self::SING_UP_NEW;
    }
}
