<?php

declare(strict_types=1);

namespace Patterns\AbstractFactory\Database;

use Exception;

class DatabaseException extends Exception
{
    public const UNDEFINED_SPELL = 'Нет данных по указанному заклинанию';
}
