<?php

declare(strict_types=1);

namespace Patterns\Structural\Bridge\API\Service;

class DealerServiceAPI extends AbstractAPIService
{
    /**
     * @param string $id
     * @return array
     * @throws ServiceAPIException
     */
    public function findProduct(string $id): array
    {
        throw new ServiceAPIException(ServiceAPIException::FORBIDDEN, 404);
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
