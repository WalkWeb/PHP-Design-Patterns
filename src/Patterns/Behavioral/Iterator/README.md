<h1>Iterator (Итератор)</h1>

<p>
    <i>
        Применение: когда необходимо реализовать какую-то особую механику итрации или желание создать коллекцию
         чего-либо, со строгой типизацией.
    </i>
</p>

<p>
    Рассмотрим пример на практике
</p>

<p>
    Допустим, в нашем проекте необходимо использовать коллекцию пользователей. Самый простой вариант, по которому может
     пойти программист — это просто создать массив:
</p>

    $users = [];
    $users[] = new User('Маша');
    $users[] = new User('Даша');
    $users[] = new User('Паша');

<p>
    Но проблема использования массивов в том, что при его использовании мы не можем наверняка знать, что он содержит
    нужные данные.
</p>

<p>
    И чтобы точно быть в этом уверенным, необходимо каждый раз при использовании делать проверки:
</p>

    foreach ($users as $user) {
        // Проверяем, что нужный элемент в массиве действительно тот, что мы ожидаем
        if (!($user instanceof UserInterface)) {
            echo 'Некорректный элемент в массиве!';
            continue;
        }
        // Чтобы IDE понимал, с объектом какого интерфейса мы работаем - ему об этому нужно указать отдельно
        /** @var $user UserInterface */
        // Только после двух операций выше мы можем уверенно работать с объектом
        echo $user->getName() . '<br />';
    }

<p>
    Разумеется, это не удобно. Тем более, рано или поздно можно забыть прописать нужную проверку, и именно в этом месте 
    может возникнуть ошибка.
</p>

<p>
    Решение — сделать коллекцию (итератор), который на метод current() вернет объект нужного интерфейса:
</p>

    /**
     * @return UserInterface
     */
    public function current(): UserInterface
    {
        return current($this->elements);
    }

<p>
    И еще, для примера, немного усложним задачу — к примеру, наша коллекция должна иметь лимит на количество итераций.
</p>

<p>
    В этом случае её код будет выглядеть так:
</p>

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
         * @return int
         */
        public function getIteration(): int
        {
            return $this->iteration;
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
            var_dump($this->iteration);
            return next($this->elements);
        }
        public function rewind(): void
        {
            reset($this->elements);
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
            return count($this->elements);
        }
    }

<p>
    Что получаем на практике — объект, который можем итерировать как массив, объект, в котором мы можем задавать 
    ограничение на лимит итераций, и объект который имеет только нужные нам данные (что-то другое просто не получится 
    добавить):
</p>

    $collection = new UserCollection(3);
    $collection->add(new User('Маша'));
    $collection->add(new User('Даша'));
    $collection->add(new User('Паша'));
    $collection->add(new User('Юля'));
    $collection->add(new User('Оля'));
    foreach ($collection as $user) {
        echo $user->getName() . '<br />'; // Маша Даша Паша
    }
    
    echo count($collection); // 3