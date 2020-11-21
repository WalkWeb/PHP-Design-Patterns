<?php

declare(strict_types=1);

namespace Patterns\Other\NullObject\Character\Action;

class NullAction implements ActionInterface
{
    public function handleMethod(): string
    {
        return self::NULL_HANDLER;
    }

    public function getPower(): int
    {
        return 0;
    }
}
