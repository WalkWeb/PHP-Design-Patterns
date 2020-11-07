<?php

declare(strict_types=1);

namespace Patterns\NullObject\Character\Action;

interface ActionInterface
{
    public const TRAP_HANDLER = 'handleTrapAction';
    public const GOLD_HANDLER = 'handleGoldAction';
    public const NULL_HANDLER = 'handleNullAction';

    public function handleMethod(): string;
    public function getPower(): int;
}
