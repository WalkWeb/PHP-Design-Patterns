<?php

namespace Patterns\Structural\Facade;

class Book
{
    /**
     * Представим, что этот метод ищет самую популярную книгу по указанному автору и предпочтению пользователя
     *
     * @return string
     */
    public function getPopularBookByAuthor(): string
    {
        return 'Песнь Льда и Пламени';
    }
}
