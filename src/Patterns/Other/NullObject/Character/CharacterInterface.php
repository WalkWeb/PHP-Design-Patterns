<?php

namespace Patterns\Other\NullObject\Character;

use Patterns\Other\NullObject\Character\Action\ActionInterface;

interface CharacterInterface
{
    public function getHp(): int;
    public function getGold(): int;
    public function handleAction(ActionInterface $action): void;
}
