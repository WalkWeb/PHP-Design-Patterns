<?php

declare(strict_types=1);

namespace Patterns\Structural\Bridge\API\Service;

interface APIServiceInterface
{
    public function findProduct(string $id): array;
    public function findAllProducts(): array;
}
