<?php

declare(strict_types=1);

namespace Tests\Creational\Builder\MySQL;

use Patterns\Creational\Builder\QueryBuilder\MySQL\MySQLQueryBuilder;
use Patterns\Creational\Builder\QueryBuilder\MySQL\MySQLQueryBuilderException;
use Patterns\Creational\Builder\QueryBuilder\Query\QueryException;
use PHPUnit\Framework\TestCase;

class MySQLQueryBuilderTest extends TestCase
{
    /**
     * @throws MySQLQueryBuilderException
     * @throws QueryException
     */
    public function testMySQLQueryBuilder(): void
    {
        $sql = "SELECT * FROM users WHERE name = 'Вася' AND year = 30 ORDER BY year DESC LIMIT 10;";
        $builder = new MySQLQueryBuilder();
        $query = $builder
            ->select('users')
            ->where('name', 'Вася')
            ->andWhere('year', 30)
            ->orderBy('year', false)
            ->limit(10)
            ->getQuery();

        self::assertEquals($sql, $query->getSQL());
    }
}
