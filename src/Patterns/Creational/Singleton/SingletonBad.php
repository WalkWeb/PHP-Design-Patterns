<?php

namespace Patterns\Creational\Singleton;

/**
 * Этот класс НЕ выполняет паттерн синглтона
 *
 * Он написан ДЛЯ ТЕСТОВ, чтобы показать разницу между обычным классом и синглтоном
 *
 * @package Patterns
 */
class SingletonBad
{
    private static $badInstance;

    public static function getBadInstance(): SingletonBad
    {
        self::$badInstance = new self();
        return self::$badInstance;
    }
}
