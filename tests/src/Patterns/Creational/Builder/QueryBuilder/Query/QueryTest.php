<?php

declare(strict_types=1);

namespace Tests\Creational\Builder\QueryBuilder\Query;

use Patterns\Creational\Builder\QueryBuilder\Query\Query;
use Patterns\Creational\Builder\QueryBuilder\Query\QueryException;
use PHPUnit\Framework\TestCase;

class QueryTest extends TestCase
{
    /**
     * @throws QueryException
     */
    public function testQueryAddPartSQL(): void
    {
        $query = new Query();
        $sql = 'example sql';

        $query->addPartSQL($sql);

        self::assertEquals(substr($sql, 0, -1) . ';', $query->getSQL());
    }

    public function testQueryNotCreated(): void
    {
        $query = new Query();

        $this->expectException(QueryException::class);
        $this->expectExceptionMessage(QueryException::QUERY_NOT_CREATED);
        $query->getSQL();
    }
}
