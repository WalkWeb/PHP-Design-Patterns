<?php

declare(strict_types=1);

namespace src;

use Exception;
use PHPUnit\Framework\TestCase;

abstract class AbstractUnitTest extends TestCase
{
    protected const DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * @param string $json
     * @return array
     * @throws Exception
     */
    protected function jsonDecode(string $json): array
    {
        return json_decode($json, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @param array $data
     * @return string
     * @throws Exception
     */
    protected function jsonEncode(array $data): string
    {
        return json_encode($data, JSON_THROW_ON_ERROR);
    }
}
