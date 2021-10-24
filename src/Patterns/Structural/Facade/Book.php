<?php

namespace Patterns\Structural\Facade;

class Book
{
    /**
     * Представим, что этот метод ищет самую интересную книгу на основании данных пользователя
     *
     * @return string
     */
    public function getPopularBookByAuthor(): string
    {
        return 'Песнь Льда и Пламени';
    }
}
