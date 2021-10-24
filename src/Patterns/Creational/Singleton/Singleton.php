<?php

namespace Patterns\Creational\Singleton;

use Exception;

class Singleton
{
    /**
     * @var Singleton - здесь хранится сам объект класса
     */
    private static $instance;

    /**
     * Строка случайных символов, которая генерируется при каждом создании объекта. По ней в тестах будем проверять,
     * создается ли новый объект каждый раз, или получаем один и тот же
     *
     * @var string
     */
    private $hash;

    /**
     * Единственный метод, через который можно получить объект Singleton, и, который, собственно реализует логику
     * синглтона.
     *
     * @return Singleton
     */
    public static function getInstance(): Singleton
    {
        if (static::$instance === null) {
            static::$instance = new self;
        }

        return static::$instance;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * Защищает синглтон от создания классическим образом
     *
     * @throws Exception
     */
    private function __construct() {
        $this->hash = $this->generateString();
    }

    /**
     * Защищаем наш синглтон от клонирования
     */
    private function __clone() {}

    /**
     * Блокируем сериализацию объекта
     */
    private function __sleep() {}

    /**
     * Ну и unserialize() за компанию
     */
    private function __wakeup() {}

    /**
     * @param int $length
     * @return string
     * @throws Exception
     */
    private function generateString($length = 15): string
    {
        $chars = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $chars[random_int(1, $numChars) - 1];
        }
        return $string;
    }
}
