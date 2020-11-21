<?php

declare(strict_types=1);

namespace Patterns\Other\NullObject\Character\Action;

class GoldAction implements ActionInterface
{
    /**
     * @var int
     */
    private $power;

    /**
     * @param int $power
     */
    public function __construct(int $power)
    {
        $this->power = $power;
    }

    public function handleMethod(): string
    {
        return self::GOLD_HANDLER;
    }

    public function getPower(): int
    {
        return $this->power;
    }
}
