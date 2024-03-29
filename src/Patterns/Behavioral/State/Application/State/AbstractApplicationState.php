<?php

declare(strict_types=1);

namespace Patterns\Behavioral\State\Application\State;

use Patterns\Behavioral\State\Application\ApplicationInterface;

/**
 * Весь функционал реализуется в дочерних классах. По умолчанию любой функционал невозможен
 *
 * @package Patterns\Behavioral\State\Application\State
 */
abstract class AbstractApplicationState implements ApplicationStateInterface
{
    /**
     * @var ApplicationInterface
     */
    protected $context;

    /**
     * @param ApplicationInterface $context
     */
    public function __construct(ApplicationInterface $context)
    {
        $this->context = $context;
    }

    public function setContext(ApplicationInterface $application): void
    {
        $this->context = $application;
    }

    /**
     * @return string
     * @throws ApplicationStateException
     */
    public function auctionNew(): string
    {
        throw new ApplicationStateException(ApplicationStateException::ACTION_NOT_ALLOWED);
    }

    /**
     * @return string
     * @throws ApplicationStateException
     */
    public function auctionStart(): string
    {
        throw new ApplicationStateException(ApplicationStateException::ACTION_NOT_ALLOWED);
    }

    /**
     * @return string
     * @throws ApplicationStateException
     */
    public function auctionEnd(): string
    {
        throw new ApplicationStateException(ApplicationStateException::ACTION_NOT_ALLOWED);
    }

    /**
     * @return string
     * @throws ApplicationStateException
     */
    public function auctionClosed(): string
    {
        throw new ApplicationStateException(ApplicationStateException::ACTION_NOT_ALLOWED);
    }

    /**
     * @return string
     * @throws ApplicationStateException
     */
    public function singUp(): string
    {
        throw new ApplicationStateException(ApplicationStateException::ACTION_NOT_ALLOWED);
    }
}
