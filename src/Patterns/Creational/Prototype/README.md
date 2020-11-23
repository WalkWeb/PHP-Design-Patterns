<h1>Prototype (Прототип)</h1>

<p>
    <i>
        Применение: копирование объектов
    </i>
</p>

<p>
    В PHP есть встроенный функционал копирования объекта, который делается просто $clone = clone $object. Но, иногда 
    нужно не полностью скопировать объект, а несколько его изменить.
</p>

<p>
    Такой вариант и рассмотрим — допустим, у нас есть объект Статьи, с заголовком, содержимым и комментарием. Необходимо 
    реализовать функционал клонирования статьи, но с некоторыми отличиями — к заголовку добавлять суффикс [Копия], а 
    также не копировать комментарии.
</p>

<p>
    Переходим к коду. Интерфейс статьи:
</p>

    interface ArticlePrototypeInternet
    {
        public const COPY_SUFFIX = ' [Копия]';
    
        public function getTitle(): string;
        public function getDescription(): string;
        public function getComments(): array;
        public function __clone();
    }

<p>
    Код. Обратите внимание на метод __clone() - в нем и реализована механика копирования, точнее та её часть, которая 
    отличает её от банального копирования:
</p>

    class ArticlePrototype implements ArticlePrototypeInterface
    {
        /**
         * @var string
         */
        private $title;
        
        /**
         * @var string
         */
        private $description;
        
        /**
         * Для простоты примера - просто массив с комментариями (строками)
         *
         * @var array
         */
        private $comments;
        
        /**
         * @param string $title
         * @param string $description
         * @param array $comments
         */
        public function __construct(string $title, string $description, array $comments)
        {
            $this->title = $title;
            $this->description = $description;
            $this->comments = $comments;
        }
        
        /**
         * @return string
         */
        public function getTitle(): string
        {
            return $this->title;
        }
        
        /**
         * @return string
         */
        public function getDescription(): string
        {
            return $this->description;
        }
        
        /**
         * @return array
         */
        public function getComments(): array
        {
            return $this->comments;
        }
        
        /**
         * При копировании статьи добавляем суффикс копии, а также не копируем комментарии
         */
        public function __clone()
        {
            $this->title .= self::COPY_SUFFIX;
            $this->comments = [];
        }
    }

<p>
    И пример использования:
</p>

    $title = 'Замечательная статья';
    $description = 'Содержание статьи';
    $comments = ['комментарий №1', 'комментарий №2', 'комментарий №3'];
    $article = new ArticlePrototype($title, $description, $comments);
    $cloneArticle = clone $article;
    
    echo $article→getTitle(); // Замечательная статья [Копия]
    print_r($cloneArticle→getComments()); // []
