<?php

declare(strict_types=1);

namespace Patterns\Creational\Prototype\Article;

class ArticlePrototype implements ArticlePrototypeInterface
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * Для простоты примера - просто массив с комментариями (строками)
     *
     * @var array
     */
    private $comments;

    /**
     * @param string $title
     * @param string $description
     * @param array $comments
     */
    public function __construct(string $title, string $description, array $comments)
    {
        $this->title = $title;
        $this->description = $description;
        $this->comments = $comments;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return array
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * При копировании статьи добавляем суффикс копии, а также не копируем комментарии
     */
    public function __clone()
    {
        $this->title .= self::COPY_SUFFIX;
        $this->comments = [];
    }
}
