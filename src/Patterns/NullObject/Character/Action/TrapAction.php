<?php

declare(strict_types=1);

namespace Patterns\NullObject\Character\Action;

class TrapAction implements ActionInterface
{
    /**
     * @var int
     */
    private $power;

    /**
     * TrapAction constructor.
     * @param int $power
     */
    public function __construct(int $power)
    {
        $this->power = $power;
    }

    public function handleMethod(): string
    {
        return self::TRAP_HANDLER;
    }

    public function getPower(): int
    {
        return $this->power;
    }
}
