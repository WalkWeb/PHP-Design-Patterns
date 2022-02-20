<?php

declare(strict_types=1);

namespace Patterns\Structural\Bridge\API\Type;

class WebAPI implements TypeAPIInterface
{
    /**
     * Возвращает данные по указанному продукту, в нужном формате для web-фронта
     *
     * @param string $id
     * @return string[][]
     */
    public function getProduct(string $id): array
    {
        // Представим, что здесь есть логика получения данных по продукты из базы, по его id

        return [
            'id'   => 'e3c9b52c-c6ed-48ad-a275-aa797892f912',
            'name' => 'Product #1',
        ];
    }

    public function getProducts(): array
    {
        // Представим, что здесь есть логика получения продуктов из базы

        return [
            [
                'id'   => 'e3c9b52c-c6ed-48ad-a275-aa797892f912',
                'name' => 'Product #1',
            ],
            [
                'id'   => 'f2dc1fb4-85b2-4b5d-bac3-1d992e282557',
                'name' => 'Product #2',
            ],
            [
                'id'   => '70f7cdad-8629-49bf-8c02-028376c20889',
                'name' => 'Product #3',
            ],
        ];
    }

    public function getMeta(): array
    {
        return [
            'version' => '1.0 web',
        ];
    }
}
