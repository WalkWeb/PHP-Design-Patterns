<?php

declare(strict_types=1);

namespace Tests\Structural\Bridge\Service;

use Patterns\Structural\Bridge\API\Service\DealerServiceAPI;
use Patterns\Structural\Bridge\API\Service\ServiceAPIException;
use Patterns\Structural\Bridge\API\Type\MobileAPI;
use Patterns\Structural\Bridge\API\Type\WebAPI;
use src\AbstractUnitTest;

class DealerServiceAPITest extends AbstractUnitTest
{
    /**
     * Тест на получение данных по продукту для дилеров + Web API
     *
     * Метод недоступен для дилеров, по этому проверяем, что получено исключение
     *
     * @throws ServiceAPIException
     */
    public function testDealerServiceAPIFindProductWeb(): void
    {
        $dealerServiceAPI = new DealerServiceAPI(new WebAPI());

        $this->expectException(ServiceAPIException::class);
        $this->expectExceptionMessage(ServiceAPIException::FORBIDDEN);
        $this->expectExceptionCode(404);
        $dealerServiceAPI->findProduct('id');
    }

    /**
     * Аналогично и для Mobile API
     *
     * @throws ServiceAPIException
     */
    public function testDealerServiceAPIFindProductMobile(): void
    {
        $dealerServiceAPI = new DealerServiceAPI(new MobileAPI());

        $this->expectException(ServiceAPIException::class);
        $this->expectExceptionMessage(ServiceAPIException::FORBIDDEN);
        $this->expectExceptionCode(404);
        $dealerServiceAPI->findProduct('id');
    }

    /**
     * Тест на получение данных по всем продуктам для дилеров + Web API
     */
    public function testDealerServiceAPIFindAllProductsWeb(): void
    {
        $dealerServiceAPI = new DealerServiceAPI(new WebAPI());
        $expectedData = [
            'meta' => [
                'version' => '1.0 web',
            ],
            'data' => [
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
            ],
        ];

        self::assertEquals($expectedData, $dealerServiceAPI->findAllProducts());
    }

    /**
     * Тест на получение данных по всем продуктам для дилеров + Mobile API
     */
    public function testDealerServiceAPIFindAllProductsMobile(): void
    {
        $dealerServiceAPI = new DealerServiceAPI(new MobileAPI());
        $expectedData = [
            'meta' => [
                'version' => '1.0 mobile',
            ],
            'data' => [
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
            ],
        ];

        self::assertEquals($expectedData, $dealerServiceAPI->findAllProducts());
    }
}
