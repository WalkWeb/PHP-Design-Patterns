<?php

declare(strict_types=1);

namespace Patterns\Behavioral\Iterator\User;

use Countable;
use Iterator;

class UserCollection implements Iterator, Countable
{
    /**
     * @var array
     */
    protected $elements = [];

    /**
     * @var int
     */
    protected $iteration = 1;

    /**
     * @var int
     */
    protected $limitIteration;

    /**
     * @param int $limitIteration
     * @throws UserCollectionException
     */
    public function __construct(int $limitIteration)
    {
        if ($limitIteration < 0) {
            throw new UserCollectionException(UserCollectionException::INCORRECT_LIMIT);
        }

        $this->limitIteration = $limitIteration;
    }

    /**
     * @param UserInterface $user
     */
    public function add(UserInterface $user): void
    {
        $this->elements[] = $user;
    }

    /**
     * @return UserInterface
     */
    public function current(): UserInterface
    {
        return current($this->elements);
    }

    /**
     * @return bool|float|int|string|null
     */
    public function key()
    {
        return key($this->elements);
    }

    /**
     * @return mixed|void
     */
    public function next()
    {
        $this->iteration++;

        return next($this->elements);
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        if ($this->iteration > $this->limitIteration) {
            return false;
        }

        return key($this->elements) !== null;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        $count = count($this->elements);

        if ($count > $this->limitIteration) {
            return $this->limitIteration;
        }

        return $count;
    }

    public function rewind(): void
    {
        reset($this->elements);
    }
}
