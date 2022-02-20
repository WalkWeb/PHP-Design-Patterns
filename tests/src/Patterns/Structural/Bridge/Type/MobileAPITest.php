<?php

declare(strict_types=1);

namespace Tests\Structural\Bridge\Type;

use Patterns\Structural\Bridge\API\Type\MobileAPI;
use src\AbstractUnitTest;

class MobileAPITest extends AbstractUnitTest
{
    /**
     * Тест на получение продукта в Mobile API
     */
    public function testMobileAPIGetProduct(): void
    {
        $mobileAPI = new MobileAPI();
        $expectedData = [
            'id'          => 'e3c9b52c-c6ed-48ad-a275-aa797892f912',
            'name'        => 'Product #1',
            'description' => 'Description #1',
        ];

        self::assertEquals($expectedData, $mobileAPI->getProduct('id'));
    }

    /**
     * Тест на получение всех продуктов в Mobile API
     */
    public function testMobileAPIGetProducts(): void
    {
        $mobileAPI = new MobileAPI();
        $expectedData = [
            [
                'id'          => 'e3c9b52c-c6ed-48ad-a275-aa797892f912',
                'name'        => 'Product #1',
                'description' => 'Description #1',
            ],
            [
                'id'          => 'f2dc1fb4-85b2-4b5d-bac3-1d992e282557',
                'name'        => 'Product #2',
                'description' => 'Description #2',
            ],
            [
                'id'          => '70f7cdad-8629-49bf-8c02-028376c20889',
                'name'        => 'Product #3',
                'description' => 'Description #3',
            ],
        ];

        self::assertEquals($expectedData, $mobileAPI->getProducts());
    }

    /**
     * Тест на получение мета-данных Mobile API
     */
    public function testMobileAPIGetMeta(): void
    {
        $mobileAPI = new MobileAPI();
        $expectedData = [
            'version' => '1.0 mobile',
        ];

        self::assertEquals($expectedData, $mobileAPI->getMeta());
    }
}
