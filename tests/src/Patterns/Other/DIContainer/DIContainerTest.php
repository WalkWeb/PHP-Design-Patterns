<?php

declare(strict_types=1);

namespace Tests\Other\DIContainer;

use Exception;
use Patterns\Other\DIContainer\DBConnection;
use Patterns\Other\DIContainer\DIContainer;
use Patterns\Other\DIContainer\DIContainerException;
use Patterns\Other\DIContainer\Model;
use src\AbstractUnitTest;

class DIContainerTest extends AbstractUnitTest
{
    /**
     * Тест на создание Model через контейнер внедрения зависимости, и что при повторном создании берется уже созданный
     *
     * @throws Exception
     */
    public function testDIContainerCreateModel(): void
    {
        $container = new DIContainer();

        $model = $container->get(Model::class);

        self::assertInstanceOf(Model::class, $model);
        self::assertInstanceOf(DBConnection::class, $model->getDb());

        // Запрашивая этот же объект еще раз - мы получаем уже созданный и сохраненный объект в контейнере
        self::assertEquals($model->getHash(), $container->get(Model::class)->getHash());
    }

    /**
     * Тест на создание неизвестного объекта
     *
     * @throws Exception
     */
    public function testDIContainerUndefinedClass(): void
    {
        $container = new DIContainer();

        $this->expectException(DIContainerException::class);
        $this->expectExceptionMessage('Класс Patterns\Other\DIContainer\UndefinedClass не найден');
        $container->get('UndefinedClass');
    }
}
