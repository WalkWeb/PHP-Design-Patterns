<?php

declare(strict_types=1);

namespace Patterns\Creational\Builder\QueryBuilder\Query;

use Exception;

class QueryException extends Exception
{
    public const QUERY_NOT_CREATED = 'Query not created';
}
