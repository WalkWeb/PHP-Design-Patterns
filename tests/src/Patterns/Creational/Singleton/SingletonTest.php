<?php

namespace Tests\Creational\Singleton;

use Patterns\Creational\Singleton\Singleton;
use src\AbstractUnitTest;

class SingletonTest extends AbstractUnitTest
{
    /**
     * Создаем несколько переменных, с объектом Singleton, и проверяем, что в них находится один и тот же объект
     */
    public function testSingleton(): void
    {
        $singleton = Singleton::getInstance();

        // Проверяем, что при повторном создании объекта он имеет тот же хеш - т.е. мы получили тот же самый объект
        // что и был создан ранее
        self::assertSame($singleton->getHash(), Singleton::getInstance()->getHash());
    }
}
