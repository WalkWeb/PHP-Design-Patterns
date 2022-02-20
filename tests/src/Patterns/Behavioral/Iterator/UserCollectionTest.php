<?php

declare(strict_types=1);

namespace Tests\Behavioral\Iterator;

use Patterns\Behavioral\Iterator\User\User;
use Patterns\Behavioral\Iterator\User\UserCollection;
use Patterns\Behavioral\Iterator\User\UserCollectionException;
use src\AbstractUnitTest;

class UserCollectionTest extends AbstractUnitTest
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

    /**
     * @throws UserCollectionException
     */
    public function testUserCollectionLimit(): void
    {
        $collection = new UserCollection(10);

        $collection->add(new User('Маша'));
        $collection->add(new User('Даша'));
        $collection->add(new User('Паша'));

        self::assertEquals(3, $collection->count());
    }

    public function testUserCollectionIncorrectLimit(): void
    {
        $limitIteration = -1;
        $this->expectException(UserCollectionException::class);
        new UserCollection($limitIteration);
    }

    /**
     * @throws UserCollectionException
     */
    public function testUserCollectionKey(): void
    {
        $collection = new UserCollection(10);

        $collection->add(new User('Маша'));
        $collection->add(new User('Даша'));

        self::assertEquals(0, $collection->key());

        $collection->next();

        self::assertEquals(1, $collection->key());
    }
}
