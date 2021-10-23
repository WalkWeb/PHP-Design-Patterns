<?php

namespace Patterns\Other\DIContainer;

use Exception;
use ReflectionClass;
use ReflectionMethod;
use stdClass;

class DIContainer
{
    private $namespace = 'Patterns\Other\DIContainer';

    private $components;

    public function __construct()
    {
        $this->components = new stdClass();
    }

    /**
     * @param $className
     * @return object
     * @throws Exception
     */
    public function get(string $className): object
    {
        // Если класс уже был создан - просто возвращаем его из коллекции
        if (isset($this->components->{$className})) {
            return $this->components->{$className};
        }

        // Проверяем наличие класса
        if (!class_exists($className)
            && !class_exists($className = $this->namespace . '\\' . $className)) {
            throw new DIContainerException("Класс $className не найден");
        }

        // Если у создаваемого объекта есть конструктор - получаем информацию о нем,
        // и на его основании создаем необходимые объекты
        if (method_exists($className, '__construct') !== false) {
            $constructor = new ReflectionMethod($className, '__construct');
            $params = $constructor->getParameters();
            $args = [];

            // Проходим циклом по указанным зависимостям. Если указано значение по умолчанию - берем его,
            // иначе - создаем объект
            foreach ($params as $key => $param) {
                if ($param->isDefaultValueAvailable()) {
                    $args[$param->name] = $param->getDefaultValue();
                } else {
                    $class = $param->getClass();
                    if ($class !== null) {
                        // Рекурсивное создание нового объекта
                        $args[$param->name] = $this->get($class->name);
                    } else {
                        throw new DIContainerException("Не найден {$param->getClass()} в контейнере");
                    }
                }
            }

            // Создаем объект
            $refClass = new ReflectionClass($className);
            $classInstance = $refClass->newInstanceArgs($args);

        } else {
            $classInstance = new $className();
        }

        // Сохраняем, чтобы в следующий раз не создавать повторно
        $this->components->{$className} = $classInstance;

        return $classInstance;
    }
}
