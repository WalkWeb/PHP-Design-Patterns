<?php

namespace Patterns\NullObject\Character;

use Patterns\NullObject\Character\Action\ActionInterface;

interface CharacterInterface
{
    public function getHp(): int;
    public function getGold(): int;
    public function handleAction(ActionInterface $action): void;
}
