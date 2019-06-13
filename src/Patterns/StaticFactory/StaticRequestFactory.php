<?php

namespace Patterns\StaticFactory;

use Patterns\SimpleFactory\Request;

/**
 * Мы создали простую фабрику, которая за нас заполняет Request необходимымми данными и создает его. Но, зачем нам
 * создавать полноценный объект, чтобы вызвать у него один простой метод?
 *
 * Чтобы использование нашей фабрики было проще - сделаем метод статическим. И получим статическую фабрику.
 *
 * Реальный пример смотрите в библиотеке Zend\Diactoros, класс ServerRequestFactory, имеющий такой же статический метод
 * fromGlobals
 *
 * @package Patterns\SimpleFactory
 */
class StaticRequestFactory
{
    /**
     * Создает Request, заполняя его данными из суперглобальных переменных
     *
     * @return Request
     */
    public static function fromGlobals(): Request
    {
        return new Request($_SERVER, $_FILES, $_COOKIE, $_GET, $_POST);
    }
}
