<?php

declare(strict_types=1);

namespace Patterns\Structural\Bridge\API\Service;

use Exception;

class ServiceException extends Exception
{
    public const FORBIDDEN = 'API method forbidden';
}
