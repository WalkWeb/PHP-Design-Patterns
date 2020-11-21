<?php

declare(strict_types=1);

namespace Patterns\Behavioral\State\Application;

use Patterns\Behavioral\State\Application\State\ApplicationStateInterface;

interface ApplicationInterface
{
    public function __construct();
    public function transitionTo(ApplicationStateInterface $state);
    public function auctionNew(): string;
    public function auctionStart(): string;
    public function auctionEnd(): string;
    public function auctionClosed(): string;
    public function singUp(): string;
}
