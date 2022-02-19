<?php

declare(strict_types=1);

namespace Patterns\Structural\Proxy\Order\Log;

use DateTimeInterface;

interface LogInterface
{
    /**
     * json запроса
     *
     * @return string
     */
    public function getRequest(): string;

    /**
     * json ответа
     *
     * @return string
     */
    public function getResponse(): string;

    /**
     * успешно ли был обработан запрос
     *
     * @return bool
     */
    public function isSuccess(): bool;

    /**
     * Ошибка обработки, если есть. Если нет - пустая строка
     *
     * @return string
     */
    public function getError(): string;

    /**
     * Дата создания лога
     *
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface;
}
