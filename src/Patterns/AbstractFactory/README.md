<h1>Abstract Factory (Абстрактная Фабрика)</h1>

<p>
    Применение: практически повсеместное
</p>

<p>
    Одна из отличительных черт хорошей архитектуры приложения — это типизация основанная на интерфейсах, 
    а не на конкретных классах. И Абстрактная Фабрика приходит как нельзя кстати, когда нам нужно создать 
    объект определенного интерфейса, при этом нам не важно, от какого именно класса будет этот объект.
</p>

<p>
    Рассмотрим практическую задачу.
</p>

<p>
    Нам необходимо реализовать систему заклинаний в игре. Заклинания могут быть разных типов, с разной логикой, 
    и мы сразу хотим заложить такую архитектуру, которая позволит все это реализовать, без переделки кода при 
    нового типа заклинаний.
</p>

<p>
    Вначале пишем интерфейс, который укажет, какие методы нужны всем заклинаниям:
</p>

    interface SpellInterface
    {
        public const TYPE_HEAL   = 1;
        public const TYPE_DAMAGE = 2;
    
        public function getId(): int;
        public function getType(): int;
        public function getName(): string;
        public function getPower(): int;
    }

<p>
    Затем, сделаем абстрактный класс заклинания, в который поместим общий для всех заклинаний функционал.
</p>

    class AbstractSpell implements SpellInterface
    {
        /**
         * @var int
         */
        protected $id;
    
        /**
         * @var int
         */
        protected $type;
    
        /**
         * @var string
         */
        protected $name;
    
        /**
         * @var int
         */
        protected $power;
    
        public function __construct(int $id, int $type, string $name, int $power)
        {
            $this->id = $id;
            $this->type = $type;
            $this->name = $name;
            $this->power = $power;
        }
    
        public function getId(): int
        {
            return $this->id;
        }
    
        public function getType(): int
        {
            return $this->type;
        }
    
        public function getName(): string
        {
            return $this->name;
        }
    
        public function getPower(): int
        {
            return $this->power;
        }
    }

<p>
    И затем, отдельными классами конкретные типы заклинаний:
</p>

    /**
     * В нашем простом примере HealSpell не имеет никакого уникального функционала, но на практике каждый тип заклинания
     * может иметь свои особенности, например, на силу лечения может влиять бонус к лечению у самого персонажа или наличие
     * каких-то спутников
     *
     * В этом случае дочерний класс будет переопределять родительский метод getPower(), и выглядеть он будет уже чуть
     * сложнее:
     * getPower(Character $character): int
     *
     * А с учетом того, что другие типы заклинаний могут требовать и другие игровые объекты для своих механик, общий
     * интерфейс может выглядеть так:
     *
     * getPower(World $world, Location $location, Character $character): int
     *
     * А в еще более сложной логике может оказаться так, что одно заклинание может иметь несколько эффектов, и в этом случае
     * будет возвращаться не просто сила заклинания, а коллекция событий для применения к персонажу
     */
    class HealSpell extends AbstractSpell
    {
    
    }

    /**
     * В нашем простом примере DamageSpell не имеет никакого уникального функционала, но на практике каждый тип заклинания
     * может иметь свои особенности, например, на силу боевого заклинания может влиять расположение персонажа - например,
     * в локациях зимы заклинания типа льда будут получать бонус к урону, а в локациях пустыни, наоборот, штраф
     *
     * В этом случае дочерний класс будет переопределять родительский метод getPower(), и выглядеть он будет уже чуть
     * сложнее:
     * getPower(Location $location): int
     *
     * А с учетом того, что другие типы заклинаний могут требовать и другие игровые объекты для своих механик, общий
     * интерфейс может выглядеть так:
     *
     * getPower(World $world, Location $location, Character $character): int
     *
     * А в еще более сложной логике может оказаться так, что одно заклинание может иметь несколько эффектов, и в этом случае
     * будет возвращаться не просто сила заклинания, а коллекция событий для применения к персонажу
     */
    class DamageSpell extends AbstractSpell
    {
    
    }

<p>
    Теперь мы хотим получить единую точку создания заклинаний, и хотим, чтобы это создание было простым, например, 
    чтобы заклинание создавалось только по его id, а с конкретным типом пускай разбирается сама Абстрактная Фабрика. 
    На выходе мы хотим получить объект, реализующий интерфейс заклинания, и больше нас ничего не интересует.
</p>

<p>
    В нашем простом примере фабрика будет выглядеть так:
</p>

    class SpellFactory implements SpellFactoryInterface
    {
        /**
         * @var DatabaseInterface
         */
        private $database;
    
        public function __construct(DatabaseInterface $database)
        {
            $this->database = $database;
        }
    
        /**
         * @param int $id
         * @return SpellInterface
         * @throws DatabaseException
         * @throws SpellFactoryException
         */
        public function create(int $id): SpellInterface
        {
            $data = $this->database->findOneById($id);
    
            // todo здесь должна быть валидация данных, для простоты примера пропускаем
    
            if ($data['type'] === SpellInterface::TYPE_HEAL) {
                return new HealSpell($data['id'], $data['type'], $data['name'], $data['power']);
            }
    
            if ($data['type'] === SpellInterface::TYPE_DAMAGE) {
                return new DamageSpell($data['id'], $data['type'], $data['name'], $data['power']);
            }
    
            throw new SpellFactoryException(SpellFactoryException::UNDEFINED_TYPE);
        }
    }

<p>
    В тестах можно посмотреть пример использования:
</p>

        $database = new DatabaseMock();
        $factory = new SpellFactory($database);
        
        // Получаем объект HealSpell
        $spell = $factory->create(1);

        // Получаем объект DamageSpell
        $spell = $factory->create(2);
