<?php

declare(strict_types=1);

namespace Patterns\Creational\Builder\QueryBuilder\Query;

class Query implements QueryInterface
{
    /**
     * @var string
     */
    private $sql = '';

    /**
     * @param string $sqlPart
     */
    public function addPartSQL(string $sqlPart): void
    {
        $this->sql .= $sqlPart;
    }

    /**
     * @return string
     * @throws QueryException
     */
    public function getSQL(): string
    {
        if ($this->sql === '') {
            throw new QueryException(QueryException::QUERY_NOT_CREATED);
        }

        return substr($this->sql, 0, -1) . ';';
    }
}
