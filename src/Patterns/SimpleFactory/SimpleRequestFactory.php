<?php

namespace Patterns\SimpleFactory;

/**
 * Простая фабрика - это объект, который создает и возвращает какой-то другой объект.
 *
 * Допустим, у нас есть объект Request, который принимает в конструктор большое количество параметров (в реальности
 * больше, чем указано ниже), и чтобы каждый раз их все не писать (а для некоторых еще нужно сделать небольшую
 * предварительную обработку) мы создаем объект SimpleRequestFactory, который и будет за нас делать эту работу.
 *
 * @package Patterns\SimpleRequestFactory
 */
class SimpleRequestFactory
{
    /**
     * Создает Request, заполняя его данными из суперглобальных переменных
     *
     * @return Request
     */
    public function fromGlobals(): Request
    {
        return new Request($_SERVER, $_FILES, $_COOKIE, $_GET, $_POST);
    }
}
