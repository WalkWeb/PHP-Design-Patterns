<?php

declare(strict_types=1);

namespace Patterns\Behavioral\State\Application;

use Patterns\Behavioral\State\Application\State\ApplicationStateException;
use Patterns\Behavioral\State\Application\State\ApplicationStateInterface;
use Patterns\Behavioral\State\Application\State\ApplicationStateNew;

class Application implements ApplicationInterface
{
    /**
     * @var ApplicationStateInterface
     */
    private $state;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->state = new ApplicationStateNew($this);
    }

    /**
     * @param ApplicationStateInterface $state
     */
    public function setContext(ApplicationStateInterface $state): void
    {
        $this->state = $state;
    }

    /**
     * @param ApplicationStateInterface $state
     */
    public function transitionTo(ApplicationStateInterface $state): void
    {
        $this->state = $state;
    }

    /**
     * @return string
     * @throws ApplicationStateException
     */
    public function auctionNew(): string
    {
        return $this->state->auctionNew();
    }

    /**
     * @return string
     * @throws ApplicationStateException
     */
    public function auctionStart(): string
    {
        return $this->state->auctionStart();
    }

    /**
     * @return string
     * @throws ApplicationStateException
     */
    public function auctionEnd(): string
    {
        return $this->state->auctionEnd();
    }

    /**
     * @return string
     * @throws ApplicationStateException
     */
    public function auctionClosed(): string
    {
        return $this->state->auctionClosed();
    }

    /**
     * @return string
     * @throws ApplicationStateException
     */
    public function singUp(): string
    {
        return $this->state->singUp();
    }
}
