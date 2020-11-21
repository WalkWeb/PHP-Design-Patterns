<?php

declare(strict_types=1);

namespace Tests\Behavioral\Iterator;

use Patterns\Behavioral\Iterator\User\User;
use Patterns\Behavioral\Iterator\User\UserCollection;
use Patterns\Behavioral\Iterator\User\UserCollectionException;
use PHPUnit\Framework\TestCase;

class UserCollectionTest extends TestCase
{
    /**
     * @throws UserCollectionException
     */
    public function testUserCollectionSuccess(): void
    {
        $limitIteration = 3;
        $collection = new UserCollection($limitIteration);

        $collection->add(new User('Маша'));
        $collection->add(new User('Даша'));
        $collection->add(new User('Паша'));
        $collection->add(new User('Юля'));
        $collection->add(new User('Оля'));

        self::assertCount($limitIteration, $collection);

        $i = 0;

        foreach ($collection as $item) {
            $i++;
        }

        self::assertEquals($limitIteration, $i);
    }

    public function testUserCollectionIncorrectLimit(): void
    {
        $limitIteration = -1;
        $this->expectException(UserCollectionException::class);
        new UserCollection($limitIteration);
    }
}
