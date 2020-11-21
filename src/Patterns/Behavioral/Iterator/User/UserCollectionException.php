<?php

declare(strict_types=1);

namespace Patterns\Behavioral\Iterator\User;

use Exception;

class UserCollectionException extends Exception
{
    public const INCORRECT_LIMIT = 'Incorrect limit user';
}
