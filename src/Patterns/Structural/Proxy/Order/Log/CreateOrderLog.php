<?php

declare(strict_types=1);

namespace Patterns\Structural\Proxy\Order\Log;

use DateTime;
use DateTimeInterface;

class CreateOrderLog implements LogInterface
{
    /**
     * @var string
     */
    private $request;

    /**
     * @var string
     */
    private $response = '';

    /**
     * @var bool
     */
    private $success = false;

    /**
     * @var string
     */
    private $error = '';

    /**
     * @var DateTimeInterface
     */
    private $createdAt;

    public function __construct(string $request)
    {
        $this->request = $request;
        $this->createdAt = new DateTime();
    }

    /**
     * @return string
     */
    public function getRequest(): string
    {
        return $this->request;
    }

    /**
     * @return string
     */
    public function getResponse(): string
    {
        return $this->response;
    }

    /**
     * @param string $response
     */
    public function setResponse(string $response): void
    {
        $this->response = $response;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @param bool $success
     */
    public function setSuccess(bool $success): void
    {
        $this->success = $success;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @param string $error
     */
    public function setError(string $error): void
    {
        $this->error = $error;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }
}
