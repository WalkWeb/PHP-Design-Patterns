<?php

namespace Patterns\Other\Immutable;

/**
 * Неизменяемый объект, это объект написанный таким образом, который не изменяется после его создания или изменения.
 *
 * В приведенном ниже примере - создается объект с указанным свойством name при создании. При изменении его имени, будет
 * создан новый объект, у которого уже будет изменено свойство. Первоначально созданный объект не изменится. И новый
 * объект, который будет создан после rename() также не будет изменяться.
 *
 * ПРИМЕНЕНИЕ:
 *
 * - ?
 *
 * НЕДОСТАТКИ:
 *
 * - Дополнительный расход памяти и процессорного времени на создание новых объектов.
 *
 * @package Patterns\Immutable
 */
class Immutable
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function rename(string $name): Immutable
    {
        $new = clone $this;
        $new->name = $name;
        return $new;
    }
}
