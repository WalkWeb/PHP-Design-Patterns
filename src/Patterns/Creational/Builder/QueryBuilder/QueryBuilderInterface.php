<?php

declare(strict_types=1);

namespace Patterns\Creational\Builder\QueryBuilder;

use Patterns\Creational\Builder\QueryBuilder\Query\Query;

/**
 * Классическая реализация паттерна Builder - это QueryBuilder в любой ORM
 *
 * Для примера паттерна Builder сделаем крайне упрощенный аналог
 *
 * @package Patterns\Builder\QueryBuilder
 */
interface QueryBuilderInterface
{
    public function select(string $table): self;
    public function where(string $filed, string $value): self;
    public function andWhere(string $filed, $value): self;
    public function orderBy(string $filed, ?bool $asc = true): self;
    public function limit(int $limit): self;
    public function getQuery(): Query;
}
