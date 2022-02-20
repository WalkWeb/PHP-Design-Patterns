<?php

declare(strict_types=1);

namespace Patterns\Structural\Bridge\API\Service;

class UserServiceAPI extends AbstractAPIService
{
    /**
     * @param string $id
     * @return array
     */
    public function findProduct(string $id): array
    {
        return [
            'meta' => $this->api->getMeta(),
            'data' => $this->api->getProduct($id)
        ];
    }

    /**
     * @return array
     * @throws ServiceAPIException
     */
    public function findAllProducts(): array
    {
        throw new ServiceAPIException(ServiceAPIException::FORBIDDEN, 404);
    }
}
