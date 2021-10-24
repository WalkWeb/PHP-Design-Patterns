<?php

namespace Patterns\Structural\Facade;

class Facade
{
    /**
     * Возвращает готовую строку для отображения рекомендации на сайте
     *
     * @return string
     */
    public static function getRecommendation(): string
    {
        $author = new Author();
        $book = new Book();
        $shop = new Shop();

        return sprintf(
            'Рекомендуемый автор: %s, рекомендуемая книга автора: %s, купить рядом с вами в магазине %s',
            $author->getRecommendationAuthor(),
            $book->getPopularBookByAuthor(),
            $shop->getNearestShop());
    }
}
