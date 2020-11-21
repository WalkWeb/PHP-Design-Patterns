<?php

namespace Patterns\Other\DIContainer;

/**
 * Контейнер внедрения зависиомости - это объект (иногда, как в Laravel, один метод), который создает указанные объекты
 * таким образом, что сам, при необходимости, создаст и передаст в конструктор нужные ему зависимости.
 *
 * В этом же объекте можно указать какие-то параметры, по которым будут создаваться объекты.
 *
 * Обычно, контейнер внедрения зависимости является ядром фреймворка (например, в Yii2 центральный объект Yii имеет
 * объект-свойство $container, который и вляется контейнером внедрения зависимости).
 *
 * Пример использования:
 *
 * use Patterns\DIContainer\Application;
 * use Patterns\DIContainer\Model;
 *
 * $application = new DIContainer();
 *
 * try {
 *     $model = $application->Model;
 *     var_dump($model instanceof Model); // true
 * } catch (Exception $e) {
 *     echo $e->getMessage();
 * }
 * @package Patterns\DIContainer
 */
class DIContainer
{
    private $namespace = 'Patterns\DIContainer';

    private $components;

    public function __construct()
    {
        $this->components = new \stdClass();
    }

    /**
     * @param $className
     * @return object
     * @throws \Exception
     * @throws \ReflectionException
     */
    public function __get(string $className): object
    {
        // Если класс уже был создан - просто возвращаем его из коллекции
        if (isset($this->components->{$className})) {
            return $this->components->{$className};
        }

        // Проверяем наличие класса
        if (!class_exists($className)
            && !class_exists($className = $this->namespace . '\\' . $className)) {
            throw new \Exception("Класс $className не найден");
        }

        // Если у создаваемого объекта есть конструктор - получаем информацию о нем,
        // и на его основании создаем необходимые объекты
        if (method_exists($className, '__construct') !== false) {
            $constructor = new \ReflectionMethod($className, '__construct');
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
                        $args[$param->name] = $this->{$class->name};
                    } else {
                        throw new \Exception("Не найден {$class->name} в контейнере");
                    }
                }
            }

            // Создаем объект
            $refClass = new \ReflectionClass($className);
            $classInstance = $refClass->newInstanceArgs($args);

        } else {
            $classInstance = new $className();
        }

        // Сохраняем, чтобы в следующий раз не создавать повторно
        $this->components->{$className} = $classInstance;

        return $classInstance;
    }
}
