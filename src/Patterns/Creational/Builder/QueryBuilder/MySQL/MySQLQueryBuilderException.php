<?php

declare(strict_types=1);

namespace Patterns\Creational\Builder\QueryBuilder\MySQL;

use Exception;

class MySQLQueryBuilderException extends Exception
{
    public const INCORRECT_WHERE_PARAMETER = 'Некорректный тип параметра для WHERE, он должно быть string или int';
}
