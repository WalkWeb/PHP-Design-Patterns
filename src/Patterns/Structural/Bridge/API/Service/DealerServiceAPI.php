<?php

declare(strict_types=1);

namespace Patterns\Structural\Bridge\API\Service;

class DealerServiceAPI extends AbstractAPIService
{
    /**
     * @param string $id
     * @return array
     * @throws ServiceException
     */
    public function findProduct(string $id): array
    {
        throw new ServiceException(ServiceException::FORBIDDEN . ': ' . __METHOD__, 404);
    }

    /**
     * @return array
     */
    public function findAllProducts(): array
    {
        return [
            'meta' => $this->api->getMeta(),
            'data' => $this->api->getProducts()
        ];
    }
}
