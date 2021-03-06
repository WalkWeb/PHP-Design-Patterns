<?php

namespace Patterns\Structural\DI;

/**
 * Если поставить задачу написания максимально простого класса, который бы реализовывал паттерн внедрения зависимости,
 * то он, пожалуй, выглядел бы так.
 *
 * Суть паттерна проста - мы при создании объекта сразу указываем и задаем его свойства, от которых, в дальнейшем,
 * будет зависить его поведение (или результат работы).
 *
 * ПРИМЕНЕНИЕ:
 *
 * - Когда мы задаем все нужные свойства объекта, сразу через конструктор, мы избавляемся от ситуаций, когда идет
 * обращение к какому-нибудь методу объекта, он, в свою очередь, обращается к своему свойству, а это свойство забыли
 * задать (потому что оно задается не в конструкторе, а отдельным методом), что приводит к ошибке.
 *
 * НЕДОСТАТКИ:
 *
 * -/-
 *
 * @package Patterns\DependencyInjection
 */
class SimpleDI
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
