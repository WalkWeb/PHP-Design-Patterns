<?php

namespace Patterns\Other\Immutable;

class ImmutableUser
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function rename(string $name): self
    {
        $new = clone $this;
        $new->name = $name;
        return $new;
    }
}
