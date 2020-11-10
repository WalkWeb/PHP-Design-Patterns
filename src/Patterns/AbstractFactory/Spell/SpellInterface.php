<?php

declare(strict_types=1);

namespace Patterns\AbstractFactory\Spell;

interface SpellInterface
{
    public const TYPE_HEAL   = 1;
    public const TYPE_DAMAGE = 2;

    public function getId(): int;
    public function getType(): int;
    public function getName(): string;
    public function getPower(): int;
}
