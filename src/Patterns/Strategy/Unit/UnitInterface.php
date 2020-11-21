<?php

declare(strict_types=1);

namespace Patterns\Strategy\Unit;

interface UnitInterface
{
    public function getName(): string;

    /**
     * Для простоты примера метод просто возвращает текстовое описание, что бот будет делать при встрече с врагом
     *
     * @return string
     */
    public function atMeetingEnemy(): string;
}
