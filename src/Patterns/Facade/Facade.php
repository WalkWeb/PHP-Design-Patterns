<?php

namespace Patterns\Facade;

/**
 * Представим, что у нас есть какая-то сложная система рекомендации книг, но в конечном итоге нам хотелось бы
 * иметь просто один класс, с методом, который бы возвращал рекомендацию для пользователя, которая будет
 * отображаться на сайте.
 *
 * Для этих целей используется фасад
 *
 * ПРИМЕНЕНИЕ:
 *
 * - Упрощение взаимодействия с группой логически связанных объектов
 *
 * НЕДОСТАТКИ:
 *
 * - Если команда увлекается фасадами, то через некоторое время можно обнаружить, что на 10 реально работающих объектов
 * приходится 50 объектов-фасадов над ними и фасадов над фасадами, что, в конечном итоге, излишне усложняет работу.
 *
 * @package Patterns\Facade
 */
class Facade
{
    private $author;

    private $book;

    private $shop;

    public function __construct()
    {
        $this->author = new Author();
        $this->book = new Book();
        $this->shop = new Shop();
    }

    /**
     * Возвращает готовый контент для отображения рекомендации на сайте
     *
     * Иногда, для еще большего удобства, метод делают статическим.
     *
     * @return string
     */
    public function getRecommendation(): string
    {
        return
            'Рекомендуемый автор: ' . $this->author->getRecommendationAuthor() .
            ' Его лучшая книга: ' . $this->book->getPopularBookByAuthor() .
            ' Ближайший магазин, где вы можете приобрести эту книгу: ' . $this->shop->getNearestShop();
    }
}