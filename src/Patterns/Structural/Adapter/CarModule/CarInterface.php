<?php

namespace Patterns\Structural\Adapter\CarModule;

interface CarInterface
{
    public function name(): string;
    public function description(): string;
    public function price(): int;
}
