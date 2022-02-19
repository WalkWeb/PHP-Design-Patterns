<?php

declare(strict_types=1);

namespace Patterns\Structural\Proxy\Order;

use Ramsey\Uuid\Uuid;

class Order implements OrderInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string[]
     */
    private $positions;

    public function __construct(string $user, array $positions)
    {
        $this->id = (string)Uuid::uuid4();
        $this->user = $user;
        $this->positions = $positions;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @return array
     */
    public function getPositions(): array
    {
        return $this->positions;
    }
}
