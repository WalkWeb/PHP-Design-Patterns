<?php

declare(strict_types=1);

namespace Tests\Creational\Builder\QueryBuilder\MySQL;

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

    /**
     * @throws MySQLQueryBuilderException
     * @throws QueryException
     */
    public function testMySQLQueryBuilderWhereString(): void
    {
        $builder = new MySQLQueryBuilder();

        $query = $builder
            ->where('name', 'Вася');

        self::assertEquals("WHERE name = 'Вася';", $query->getQuery()->getSQL());
    }

    /**
     * @throws MySQLQueryBuilderException
     * @throws QueryException
     */
    public function testMySQLQueryBuilderWhereInteger(): void
    {
        $builder = new MySQLQueryBuilder();

        $query = $builder
            ->where('year', 30);

        self::assertEquals("WHERE year = 30;", $query->getQuery()->getSQL());
    }

    /**
     * @throws MySQLQueryBuilderException
     * @throws QueryException
     */
    public function testMySQLQueryBuilderAndWhereString(): void
    {
        $builder = new MySQLQueryBuilder();

        $query = $builder
            ->andWhere('name', 'Вася');

        self::assertEquals("AND name = 'Вася';", $query->getQuery()->getSQL());
    }

    /**
     * @throws MySQLQueryBuilderException
     * @throws QueryException
     */
    public function testMySQLQueryBuilderAndWhereInteger(): void
    {
        $builder = new MySQLQueryBuilder();

        $query = $builder
            ->andWhere('year', 30);

        self::assertEquals("AND year = 30;", $query->getQuery()->getSQL());
    }

    public function testMySQLQueryBuilderIncorrectWhereParameter(): void
    {
        $builder = new MySQLQueryBuilder();

        $this->expectException(MySQLQueryBuilderException::class);
        $this->expectExceptionMessage(MySQLQueryBuilderException::INCORRECT_WHERE_PARAMETER);
        $builder->where('param', true);
    }

    public function testMySQLQueryBuilderIncorrectAndWhereParameter(): void
    {
        $builder = new MySQLQueryBuilder();

        $this->expectException(MySQLQueryBuilderException::class);
        $this->expectExceptionMessage(MySQLQueryBuilderException::INCORRECT_WHERE_PARAMETER);
        $builder->andWhere('param', true);
    }
}
