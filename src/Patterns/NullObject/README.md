<h1>NullObject</h1>

<p>
    <i>Назначение: избавляемся от обработки null в логике, избавляемся от лишних if, if, if… в коде.</i>
</p>

<p>
    Представим себе ситуацию, что мы проектируем некоторый игровой мир, который оказывает влияние
    на персонажа.
</p>

<p>
    Мир поделен на эпизоды, и в изначальной задаче эпизоды могли быть только двух типов: ловушка 
    и нашли золото. Также, каждый эпизод имеет текстовое описание, которое рассказывает игроку, 
    какое событие произошло с его персонажем.
</p>

<p>
    Логика проста и понятна, и пишем интерфейсы:
</p>

    interface CharacterInterface
    {
        public function getHp(): int;
        public function getGold(): int;
        public function handleAction(ActionInterface $action): void;
    }
    
    interface EpisodeInterface
    {
        public function getDescription(): string;
        public function getAction(): ActionInterface;
    }
    
    interface ActionInterface
    {
        public const TRAP_HANDLER = 'handleTrapAction';
        public const GOLD_HANDLER = 'handleGoldAction';
    
        public function handleMethod(): string;
        public function getPower(): int;
    }

<p>
    Но, затем приходит задача добавить механику информационного эпизода, который не будет оказывать
    никакого влияния на нашего персонажа (а только рассказывать о месте, куда он попал).
</p>

<p>
    Допустим, программист не находит ничего лучше, чем заменить:
</p>

    interface EpisodeInterface
    {
        //…
    
        public function getAction(): ActionInterface;
    }

<p>
    На:
</p>

    interface EpisodeInterface
    {
        //…
    
        public function getAction(): ?ActionInterface;
    }

<p>
    Т.е. эпизод теперь возвращает не событие, а может быть событие, а может быть null
</p>

<p>
    И, разумеется, мы теперь вынуждены <b>каждый раз</b>, используя этот метод, проверять значение
    на null, и отдельно его обрабатывать.
</p>

<p>
    Но есть вариант сделать лучше — мы просто добавляем новый тип события - NullAction, который
    вызывает пустой метод handleNullAction у персонажа. Никаких других правок кода совершать не
    нужно — логика «течет» по тому же маршруту и никаких новых условий и проверок не появилось.
</p>
