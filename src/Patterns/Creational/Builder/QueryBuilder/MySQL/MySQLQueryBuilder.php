<?php

declare(strict_types=1);

namespace Patterns\Creational\Builder\QueryBuilder\MySQL;

use Patterns\Creational\Builder\QueryBuilder\Query\Query;
use Patterns\Creational\Builder\QueryBuilder\QueryBuilderInterface;

/**
 * Механика формирования SQL-кода сделана крайне упрощенной для примера. В реальном QueryBuilder все сильно сложнее.
 */
class MySQLQueryBuilder implements QueryBuilderInterface
{
    /**
     * @var Query
     */
    private $query;

    /**
     * @param Query|null $query
     */
    public function __construct(?Query $query = null)
    {
        $this->query = $query ?? new Query();
    }

    /**
     * @param string $table
     * @return $this|QueryBuilderInterface
     */
    public function select(string $table): QueryBuilderInterface
    {
        $this->query->addPartSQL("SELECT * FROM $table ");

        return $this;
    }

    /**
     * @param string $filed
     * @param string|int $value
     * @param bool $andWhere
     * @return $this|QueryBuilderInterface
     * @throws MySQLQueryBuilderException
     */
    public function where(string $filed, $value, bool $andWhere = false): QueryBuilderInterface
    {
        if (!is_string($value) && !is_int($value)) {
            throw new MySQLQueryBuilderException(MySQLQueryBuilderException::INCORRECT_WHERE_PARAMETER);
        }

        if ($andWhere) {
            $this->query->addPartSQL('AND ');
        }

        if (is_int($value)) {
            if ($andWhere) {
                $this->query->addPartSQL("$filed = $value ");
            } else {
                $this->query->addPartSQL("WHERE $filed = $value ");
            }
        }

        if (is_string($value)) {
            if ($andWhere) {
                $this->query->addPartSQL("$filed = '$value' ");
            } else {
                $this->query->addPartSQL("WHERE $filed = '$value' ");
            }
        }

        return $this;
    }

    /**
     * @param string $filed
     * @param $value
     * @return QueryBuilderInterface
     * @throws MySQLQueryBuilderException
     */
    public function andWhere(string $filed, $value): QueryBuilderInterface
    {
        $this->where($filed, $value, true);

        return $this;
    }

    /**
     * @param string $filed
     * @param bool|null $asc
     * @return $this|QueryBuilderInterface
     */
    public function orderBy(string $filed, ?bool $asc = true): QueryBuilderInterface
    {
        $this->query->addPartSQL("ORDER BY $filed ");

        if (!$asc) {
            $this->query->addPartSQL("DESC ");
        }

        return $this;
    }

    /**
     * @param int $limit
     * @return $this|QueryBuilderInterface
     */
    public function limit(int $limit): QueryBuilderInterface
    {
        $this->query->addPartSQL("LIMIT $limit ");

        return $this;
    }

    /**
     * @return Query
     */
    public function getQuery(): Query
    {
        return $this->query;
    }
}
