<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Patterns\Singleton;
use Patterns\SingletonBad;

class SingletonTest extends TestCase
{
    /**
     * Создаем несколько переменных, с объектом Singleton, и проверяем, что в них находится один и тот же объект
     */
    public function testIdentity(): void
    {
        $singleton1 = Singleton::getInstance();
        $singleton2 = Singleton::getInstance();

        $this->assertSame($singleton1, $singleton2);
    }

    /**
     * А здесь обратная ситуация, у нас есть класс SingletonBad, который хоть и возвращает себя через статический метод,
     * но не реализует паттерн синглтона, и на его примере мы видим, что это два разных объекта
     */
    public function testBadIdentity(): void
    {
        $singleton1 = SingletonBad::getBadInstance();
        $singleton2 = SingletonBad::getBadInstance();

        $this->assertNotSame($singleton1, $singleton2);
    }
}
