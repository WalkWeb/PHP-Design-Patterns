<?php

declare(strict_types=1);

namespace Patterns\AbstractFactory\Spell;

class AbstractSpell implements SpellInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var int
     */
    protected $type;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $power;

    public function __construct(int $id, int $type, string $name, int $power)
    {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
        $this->power = $power;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPower(): int
    {
        return $this->power;
    }
}
