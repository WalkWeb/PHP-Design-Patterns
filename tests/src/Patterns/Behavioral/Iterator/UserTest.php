<?php

declare(strict_types=1);

namespace Tests\Behavioral\Iterator;

use Patterns\Behavioral\Iterator\User\User;
use src\AbstractUnitTest;

class UserTest extends AbstractUnitTest
{
    public function testUserCreate(): void
    {
        $name = 'DemoUser';
        $user = new User($name);

        self::assertEquals($name, $user->getName());
    }
}
