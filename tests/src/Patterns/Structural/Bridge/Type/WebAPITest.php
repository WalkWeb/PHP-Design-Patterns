<?php

declare(strict_types=1);

namespace Tests\Structural\Bridge\Type;

use Patterns\Structural\Bridge\API\Type\WebAPI;
use src\AbstractUnitTest;

class WebAPITest extends AbstractUnitTest
{
    /**
     * Тест на получение продукта в Web API
     */
    public function testWebAPIGetProduct(): void
    {
        $webAPI = new WebAPI();
        $expectedData = [
            'id'   => 'e3c9b52c-c6ed-48ad-a275-aa797892f912',
            'name' => 'Product #1',
        ];

        self::assertEquals($expectedData, $webAPI->getProduct('id'));
    }

    /**
     * Тест на получение всех продуктов в Web API
     */
    public function testWebAPIGetProducts(): void
    {
        $webAPI = new WebAPI();
        $expectedData = [
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

        self::assertEquals($expectedData, $webAPI->getProducts());
    }

    /**
     * Тест на получение мета-данных Web API
     */
    public function testWebAPIGetMeta(): void
    {
        $webAPI = new WebAPI();
        $expectedData = [
            'version' => '1.0 web',
        ];

        self::assertEquals($expectedData, $webAPI->getMeta());
    }
}
