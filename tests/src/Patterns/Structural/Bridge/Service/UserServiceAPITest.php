<?php

declare(strict_types=1);

namespace Tests\Structural\Bridge\Service;

use Patterns\Structural\Bridge\API\Service\ServiceAPIException;
use Patterns\Structural\Bridge\API\Service\UserServiceAPI;
use Patterns\Structural\Bridge\API\Type\MobileAPI;
use Patterns\Structural\Bridge\API\Type\WebAPI;
use src\AbstractUnitTest;

class UserServiceAPITest extends AbstractUnitTest
{
    /**
     * Тест на получение данных по продукту для пользователей + Web API
     */
    public function testUserServiceAPIFindProductWeb(): void
    {
        $userServiceAPI = new UserServiceAPI(new WebAPI());
        $expectedData = [
            'meta' => [
                'version' => '1.0 web',
            ],
            'data' => [
                'id'   => 'e3c9b52c-c6ed-48ad-a275-aa797892f912',
                'name' => 'Product #1',
            ],
        ];

        self::assertEquals($expectedData, $userServiceAPI->findProduct('id'));
    }

    /**
     * Тест на получение данных по продукту для пользователей + Mobile API
     */
    public function testUserServiceAPIFindProductMobile(): void
    {
        $userServiceAPI = new UserServiceAPI(new MobileAPI());
        $expectedData = [
            'meta' => [
                'version' => '1.0 mobile',
            ],
            'data' => [
                'id'          => 'e3c9b52c-c6ed-48ad-a275-aa797892f912',
                'name'        => 'Product #1',
                'description' => 'Description #1',
            ],
        ];

        self::assertEquals($expectedData, $userServiceAPI->findProduct('id'));
    }

    /**
     * Тест на получение данных по всем продуктам для пользователей + Mobile API
     *
     * Метод недоступен для пользователей, по этому проверяем, что получено исключение
     */
    public function testUserServiceAPIFindAllProductsWeb(): void
    {
        $userServiceAPI = new UserServiceAPI(new WebAPI());

        $this->expectException(ServiceAPIException::class);
        $this->expectExceptionMessage(ServiceAPIException::FORBIDDEN);
        $this->expectExceptionCode(404);
        $userServiceAPI->findAllProducts();
    }

    /**
     * Аналогично и для Mobile API
     */
    public function testUserServiceAPIFindAllProductsMobile(): void
    {
        $userServiceAPI = new UserServiceAPI(new MobileAPI());

        $this->expectException(ServiceAPIException::class);
        $this->expectExceptionMessage(ServiceAPIException::FORBIDDEN);
        $this->expectExceptionCode(404);
        $userServiceAPI->findAllProducts();
    }
}
