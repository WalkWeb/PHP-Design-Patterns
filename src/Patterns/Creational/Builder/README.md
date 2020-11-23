<h1>Builder (Строитель)</h1>

<p>
    <i>
        Назначение: предоставляет интерфейс для конструирования сложного объекта
    </i>
</p>

<p>
    Рассмотрим пример на практике
</p>

<p>
    Практически каждый программист работал с фреймворками и использовал встроенный в кажую ORM функционал QueryBuilder 
    — который и представляет из себя реализацию паттерна Builder
</p>

<p>
    Давайте реализуем свой, крайне упрощенный QueryBuilder
</p>

<p>
    Во-первых, напишем интерфейсы:
</p>

    interface QueryBuilderInterface
    {
        public function select(string $table): self;
        public function where(string $filed, string $value): self;
        public function andWhere(string $filed, $value): self;
        public function orderBy(string $filed, ?bool $asc = true): self;
        public function limit(int $limit): self;
        public function getQuery(): Query;
    }
    
    interface QueryInterface
    {
        public function addPartSQL(string $sqlPart): void;
        public function getSQL(): string;
    }

<p>
    QueryBuilder предоставит методы, для формирования объекта-запроса Query, а сам  Query будет просто хранить в себе 
    SQL-строку
</p>

<p>
    Перейдем к реализации:
</p>

    /**
     * Механика формирования SQL-кода сделана крайне упрощенной для примера. В реальном QueryBuilder все сильно сложнее.
     */
    class MySQLQueryBuilder implements QueryBuilderInterface
    {
        /**
         * @var Query
         */
        private $query;
        /**
         * @param Query|null $query
         */
        public function __construct(?Query $query = null)
        {
            $this->query = $query ?? new Query();
        }
        /**
         * @param string $table
         * @return $this|QueryBuilderInterface
         */
        public function select(string $table): QueryBuilderInterface
        {
            $this->query->addPartSQL("SELECT * FROM $table ");
            return $this;
        }
        /**
         * @param string $filed
         * @param string|int $value
         * @return $this|QueryBuilderInterface
         * @throws MySQLQueryBuilderException
         */
        public function where(string $filed, $value): QueryBuilderInterface
        {
            if (!is_string($value) && !is_int($value)) {
                throw new MySQLQueryBuilderException(MySQLQueryBuilderException::INCORRECT_WHERE_PARAMETER);
            }
            if (is_int($value)) {
                $this->query->addPartSQL("WHERE $filed = $value ");
            }
            if (is_string($value)) {
                $this->query->addPartSQL("WHERE $filed = '$value' ");
            }
            return $this;
        }
        /**
         * @param string $filed
         * @param $value
         * @return QueryBuilderInterface
         * @throws MySQLQueryBuilderException
         */
        public function andWhere(string $filed, $value): QueryBuilderInterface
        {
            $this->query->addPartSQL('AND ');
            if (!is_string($value) && !is_int($value)) {
                throw new MySQLQueryBuilderException(MySQLQueryBuilderException::INCORRECT_WHERE_PARAMETER);
            }
            if (is_int($value)) {
                $this->query->addPartSQL("$filed = $value ");
            }
            if (is_string($value)) {
                $this->query->addPartSQL("$filed = '$value' ");
            }
            return $this;
        }
        /**
         * @param string $filed
         * @param bool|null $asc
         * @return $this|QueryBuilderInterface
         */
        public function orderBy(string $filed, ?bool $asc = true): QueryBuilderInterface
        {
            $this->query->addPartSQL("ORDER BY $filed ");
            if (!$asc) {
                $this->query->addPartSQL("DESC ");
            }
            return $this;
        }
        /**
         * @param int $limit
         * @return $this|QueryBuilderInterface
         */
        public function limit(int $limit): QueryBuilderInterface
        {
            $this->query->addPartSQL("LIMIT $limit ");
            return $this;
        }
        /**
         * @return Query
         */
        public function getQuery(): Query
        {
            return $this->query;
        }
    }

    class Query implements QueryInterface
    {
        /**
         * @var string
         */
        private $sql = '';
        /**
         * @param string $sqlPart
         */
        public function addPartSQL(string $sqlPart): void
        {
            $this->sql .= $sqlPart;
        }
        /**
         * @return string
         * @throws QueryException
         */
        public function getSQL(): string
        {
            if ($this->sql === '') {
                throw new QueryException(QueryException::QUERY_NOT_CREATED);
            }
            return substr($this->sql, 0, -1) . ';';
        }
    }

<p>
    И использование:
</p>

    $query = $builder
        ->select('users')
        ->where('name', 'Вася')
        ->andWhere('year', 30)
        ->orderBy('year', false)
        ->limit(10)
        ->getQuery();
        
    echo $query→getSQL() // SELECT * FROM users WHERE name = 'Вася' AND year = 30 ORDER BY year DESC LIMIT 10;
