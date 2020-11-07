<?php

declare(strict_types=1);

namespace Patterns\NullObject\Character;

use Exception;

class CharacterException extends Exception
{
    public const UNDEFINED_METHOD = 'Не найден указанный метод';
}
