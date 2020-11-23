<?php

declare(strict_types=1);

namespace Patterns\Creational\Builder\QueryBuilder\Query;

/**
 * Для примера делаем крайне простой объект Query, который будет содержать в себе просто SQL-строку
 *
 * Оценить сложность реального объекта Query вы можете, например, здесь:
 * https://github.com/doctrine/orm/blob/2.7/lib/Doctrine/ORM/Query.php
 *
 * @package Patterns\Builder\QueryBuilder\Query
 */
interface QueryInterface
{
    public function addPartSQL(string $sqlPart): void;
    public function getSQL(): string;
}
