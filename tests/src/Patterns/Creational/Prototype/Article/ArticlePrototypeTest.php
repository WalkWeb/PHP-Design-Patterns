<?php

declare(strict_types=1);

namespace Tests\Creational\Prototype\Article;

use Patterns\Creational\Prototype\Article\ArticlePrototype;
use Patterns\Creational\Prototype\Article\ArticlePrototypeInterface;
use src\AbstractUnitTest;

class ArticlePrototypeTest extends AbstractUnitTest
{
    public function testPrototypeCopy(): void
    {
        $title = 'Замечательная статья';
        $description = 'Содержание статьи';
        $comments = ['комментарий №1', 'комментарий №2', 'комментарий №3'];

        $article = new ArticlePrototype($title, $description, $comments);

        $cloneArticle = clone $article;

        self::assertEquals($article->getTitle() . ArticlePrototypeInterface::COPY_SUFFIX, $cloneArticle->getTitle());
        self::assertEquals([], $cloneArticle->getComments());
        self::assertEquals($description, $cloneArticle->getDescription());
    }
}
