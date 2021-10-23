<?php

declare(strict_types=1);

namespace Tests\Other\Immutable;

use Patterns\Other\Immutable\ImmutableUser;
use PHPUnit\Framework\TestCase;

class ImmutableUserTest extends TestCase
{
    public function testImmutableUserRename(): void
    {
        $name = 'Вася';
        $user = new ImmutableUser($name);

        self::assertEquals($name, $user->getName());

        // Меняем имя на новое
        $newName = 'Василий';
        $renamedUser = $user->rename($newName);

        self::assertEquals($newName, $renamedUser->getName());

        // При этом изначальный объект не изменился
        self::assertEquals($name, $user->getName());
    }
}
