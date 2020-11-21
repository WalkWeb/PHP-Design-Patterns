<?php

declare(strict_types=1);

namespace Patterns\Behavioral\Strategy\Unit;

use Patterns\Behavioral\Strategy\Unit\Strategy\StrategyInterface;

class Unit implements UnitInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var StrategyInterface - Определяет, как бот будет поступать в различных ситуациях, например, при встрече врага
     */
    private $strategy;

    public function __construct(string $name, StrategyInterface $strategy)
    {
        $this->name = $name;
        $this->strategy = $strategy;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function atMeetingEnemy(): string
    {
        return $this->strategy->atMeetingEnemy();
    }
}
