<?php

declare(strict_types=1);

namespace Patterns\Structural\Bridge\API\Service;

interface APIServiceInterface
{
    /**
     * Возвращает данные по указанному продукту
     *
     * @param string $id
     * @return array
     */
    public function findProduct(string $id): array;

    /**
     * Возвращает данные по всем продуктам
     *
     * @return array
     */
    public function findAllProducts(): array;
}
