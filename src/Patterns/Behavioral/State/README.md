<h1>State (Состояние)</h1>

<p>
    <i>
        Назначение: реализация сложных объектов, которые могут иметь различные состояния, разную логику поведения в 
        разных состояниях и разные правила перехода из одного состояния в другое
    </i>
</p>

<p>
    Пример из практики
</p>

<p>
    Допустим, нам необходимо реализовать логику поведения заявки (товара) на аукционе. При этом заявка может находиться 
    в 4 различных статусах:
</p>

<p>
    1) Заявка на аукцион создана<br />
    2) Аукцион начался<br />
    3) Аукцион закончился<br />
    4) Заявка закрыта (отменена или сделка совершена)
</p>

<p>
    При этом заявка может переходить или не переходить из одного статуса в другое:
</p>

<p>
(New) => (Start)<br />
(New) x  (End)<br />
(New) => (Closed)<br /><br />

(Start) x  (New)<br />
(Start) => (End)<br />
(Start) => (Closed)<br /><br />

(End) x  (New)<br />
(End) => (Start)<br />
(End) => (Closed)<br /><br />

(Closed) => (New)<br />
(Closed) x  (Start)<br />
(Closed) x  (End)
</p>

<p>
    Плюс к этому, логика работы заявки зависит от состояния, например, если заявка находится в статусе №2 и подана 
    заявка на участие — нужно подписать человека на email-рассылку, а аналогичное действие в статусе №3 — уже записывает 
    пользователя как участника аукциона и его ставку.
</p>

<p>
    И помимо всего вышеописанного мы понимаем (или нам об этом говорят заказчики), что в будущем могут появиться другие 
    статусы заявки, а также новые правила перехода из одного в другое и новые особенности поведения в том или ином 
    статусе.
</p>

<p>
    Итого: сразу видна сложная логика объекта, и по мере добавления новых статусов расти она будет по экспоненциальной 
    зависимости.
</p>

<p>
    В этом случае имеет смысл применить паттерн Состояние. Суть его заключается в том, что для каждого отдельно статуса 
    (состояния) мы пишем отдельные классы, а исходный класс заявки будет внутри себя переключаться между ними. При этом 
    внешнему пользователю будет казаться, что он работает с одним обычным объектом.
</p>

<p>
    Интерфейс заявки:
</p>

    interface ApplicationInterface
    {
        public function __construct();
        public function transitionTo(ApplicationStateInterface $state);
        public function auctionNew(): string;
        public function auctionStart(): string;
        public function auctionEnd(): string;
        public function auctionClosed(): string;
        public function singUp(): string;
    }

<p>
    Интерфейс состояния:
</p>

    interface ApplicationStateInterface
    {
        public const AUCTION_NEW    = 'Аукцион открыт';
        public const AUCTION_START  = 'Аукцион стартовал';
        public const AUCTION_END    = 'Аукцион закончился';
        public const AUCTION_CLOSED = 'Аукцион закрыт';
    
        public const SING_UP_NEW    = 'Вы подписаны на email-рассылку, когда аукцион начнется вы получите уведомление';
        public const SING_UP_START  = 'Вы записаны на аукцион';
    
        public function auctionNew(): string;
        public function auctionStart(): string;
        public function auctionEnd(): string;
        public function auctionClosed(): string;
        public function singUp(): string;
    }

<p>
    Теперь реализация заявки. Как видно - класс просто переадресует внешний вызов на вызов аналогичного метода у 
    своего состояния:
</p>

    class Application implements ApplicationInterface
    {
        /**
         * @var ApplicationStateInterface
         */
        private $state;
    
        /**
         * Application constructor.
         */
        public function __construct()
        {
            $this->state = new ApplicationStateNew($this);
        }
    
        /**
         * @param ApplicationStateInterface $state
         */
        public function setContext(ApplicationStateInterface $state): void
        {
            $this->state = $state;
        }
    
        /**
         * @param ApplicationStateInterface $state
         */
        public function transitionTo(ApplicationStateInterface $state): void
        {
            $this->state = $state;
        }
    
        /**
         * @return string
         * @throws ApplicationStateException
         */
        public function auctionNew(): string
        {
            return $this->state->auctionNew();
        }
    
        /**
         * @return string
         * @throws ApplicationStateException
         */
        public function auctionStart(): string
        {
            return $this->state->auctionStart();
        }
    
        /**
         * @return string
         * @throws ApplicationStateException
         */
        public function auctionEnd(): string
        {
            return $this->state->auctionEnd();
        }
    
        /**
         * @return string
         * @throws ApplicationStateException
         */
        public function auctionClosed(): string
        {
            return $this->state->auctionClosed();
        }
    
        /**
         * @return string
         * @throws ApplicationStateException
         */
        public function singUp(): string
        {
            return $this->state->singUp();
        }
    }

<p>
    Реализация состояния. Вначале пишем абстракцию, у которой все рабочие методы бросают исключение, т.е. запрещены:
</p>

    class Application implements ApplicationInterface
    {
        /**
         * @var ApplicationStateInterface
         */
        private $state;
    
        /**
         * Application constructor.
         */
        public function __construct()
        {
            $this->state = new ApplicationStateNew($this);
        }
    
        /**
         * @param ApplicationStateInterface $state
         */
        public function setContext(ApplicationStateInterface $state): void
        {
            $this->state = $state;
        }
    
        /**
         * @param ApplicationStateInterface $state
         */
        public function transitionTo(ApplicationStateInterface $state): void
        {
            $this->state = $state;
        }
    
        /**
         * @return string
         * @throws ApplicationStateException
         */
        public function auctionNew(): string
        {
            return $this->state->auctionNew();
        }
    
        /**
         * @return string
         * @throws ApplicationStateException
         */
        public function auctionStart(): string
        {
            return $this->state->auctionStart();
        }
    
        /**
         * @return string
         * @throws ApplicationStateException
         */
        public function auctionEnd(): string
        {
            return $this->state->auctionEnd();
        }
    
        /**
         * @return string
         * @throws ApplicationStateException
         */
        public function auctionClosed(): string
        {
            return $this->state->auctionClosed();
        }
    
        /**
         * @return string
         * @throws ApplicationStateException
         */
        public function singUp(): string
        {
            return $this->state->singUp();
        }
    }

<p>
    А теперь конкретная реализация состояния новой заявки:
</p>

    class ApplicationStateNew extends AbstractApplicationState
    {
        public function auctionStart(): string
        {
            $this->context->transitionTo(new ApplicationStateStart($this->context));
            return self::AUCTION_START;
        }
    
        public function auctionClosed(): string
        {
            $this->context->transitionTo(new ApplicationStateClosed($this->context));
            return self::AUCTION_CLOSED;
        }
    
        public function singUp(): string
        {
            return self::SING_UP_NEW;
        }
    }
    
<p>
    Код других состояний можете посмотреть в исходниках.
</p>

<p>
    И вот так это выглядит в работе:
</p>

        $application = new Application();
        echo $application->singUp() . '<br />'; // Вы подписаны на email-рассылку, когда аукцион начнется вы получите уведомление
        echo $application->auctionStart() . '<br />';
        echo $application->singUp() . '<br />'; // Вы записаны на аукцион
        echo $application->auctionEnd() . '<br />';
        echo $application->auctionClosed() . '<br />';

<p>
    Вызов singUp() в одном состоянии заявки приводит к одному результату, а в другом состоянии - в другом.
</p>

<p>
    Если же выполнить запрещенный переход из одного состояния в другой, будет исключение:
</p>

    try {
        $application = new Application();
        $application->auctionEnd();
    } catch (Exception $e) {
        echo $e->getMessage() . '<br />'; // Действие недопустимо
    }

<p>
    Обратите внимание, что вся логика доступных и запрещенных переходов, а также разный функционал в разных состояния 
    реализован без единого if условия.
</p>
