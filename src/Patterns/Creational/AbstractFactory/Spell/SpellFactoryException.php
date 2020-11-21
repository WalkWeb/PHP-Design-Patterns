<?php

declare(strict_types=1);

namespace Patterns\Creational\AbstractFactory\Spell;

use Exception;

class SpellFactoryException extends Exception
{
    public const UNDEFINED_TYPE = 'Неизвестный тип заклинания';
}
