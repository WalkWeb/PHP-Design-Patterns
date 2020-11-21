<?php

declare(strict_types=1);

namespace Patterns\Behavioral\State\Application\State;

use Exception;

class ApplicationStateException extends Exception
{
    public const ACTION_NOT_ALLOWED = 'Действие недопустимо';
}
