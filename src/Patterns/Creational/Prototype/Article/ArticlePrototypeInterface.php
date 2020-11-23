<?php

declare(strict_types=1);

namespace Patterns\Creational\Prototype\Article;

interface ArticlePrototypeInterface
{
    public const COPY_SUFFIX = ' [Копия]';

    public function getTitle(): string;
    public function getDescription(): string;
    public function getComments(): array;
    public function __clone();
}
