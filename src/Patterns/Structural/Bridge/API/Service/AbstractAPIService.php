<?php

declare(strict_types=1);

namespace Patterns\Structural\Bridge\API\Service;

use Patterns\Structural\Bridge\API\Type\TypeAPIInterface;

abstract class AbstractAPIService
{
    protected $api;

    public function __construct(TypeAPIInterface $api)
    {
        $this->api = $api;
    }

    /**
     * Возвращает данные по указанному продукту
     *
     * Название метода специально отличается от методов в API, чтобы показать, что они не должны быть одинаковыми
     *
     * @param string $id
     * @return array
     */
    abstract public function findProduct(string $id): array;

    /**
     * Возвращает данные по всем продуктам
     *
     * @return array
     */
    abstract public function findAllProducts(): array;
}
