<?php

namespace Patterns\Structural\Facade;

class Author
{
    /**
     * Представим, что этот метод ищет в базе популярного Автора в жанре фентези, на основании предпочтений пользователя
     *
     * @return string
     */
    public function getRecommendationAuthor(): string
    {
        return 'Джордж Р. Р. Мартин';
    }
}
