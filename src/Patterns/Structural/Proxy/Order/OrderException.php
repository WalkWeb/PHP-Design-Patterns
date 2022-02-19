<?php

declare(strict_types=1);

namespace Patterns\Structural\Proxy\Order;

use Exception;

class OrderException extends Exception
{
    public const CREATE_ERROR = 'Create Order error';
    public const INVALID_JSON = 'Invalid json received';
}
