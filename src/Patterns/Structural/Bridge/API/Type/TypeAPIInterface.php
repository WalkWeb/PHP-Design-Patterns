<?php

declare(strict_types=1);

namespace Patterns\Structural\Bridge\API\Type;

interface TypeAPIInterface
{
    /**
     * Возвращает данные по указанному продукту
     *
     * @param string $id
     * @return array
     */
    public function getProduct(string $id): array;

    /**
     * Возвращает данные по всем продуктам
     *
     * @return array
     */
    public function getProducts(): array;

    /**
     * Возвращает описание API
     *
     * @return array
     */
    public function getMeta(): array;
}
