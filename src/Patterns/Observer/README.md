<h1>Observer (Наблюдатель)</h1>

<p>
    <i>Применение: вывод в отдельный объект логики связанной с изменением состояния
    исходного объекта</i>
</p>

<p>
    Допустим, у нас есть объект персонажа, который при получении определенных уровней
    должен получать уведомления и/или достижения. Можно всю необходимую логику прописать 
    в нем самом, но, по мере роста сложности объекта и логики может возникнуть 
    необходимость рефакторинга - разгрузить основной объект, вынеся часть его логики 
    в другие объекты.
</p>

<p>
    В этом случае паттерн Наблюдатель может отлично подойти — всю логику получения 
    уведомлений и достижений мы пропишем в них:
</p>

    class AchievementObserver implements AchievementObserverInterface
    {
        public function update(CharacterInterface $character): void
        {
            if ($character->getLevel() === self::ACHIEVEMENT_LEVEL) {
                $character->addAchievement(self::ACHIEVEMENT_NAME);
            }
        }
    }

    class NotificationObserver implements NotificationObserverInterface
    {
        public function update(CharacterInterface $character): void
        {
            if ($character->getLevel() === self::NOTIFICATION_LEVEL) {
                $character->addNotification(self::NOTIFICATION_NAME);
            }
        }
    }

<p>
    А самому персонажу добавим наблюдателей, которым в случае изменения уровня
    персонажа будем сообщать — уровень персонажа изменился — проверьте, не должны
    ли вы сделать нужные вам действия:
</p>

    class Character implements CharacterInterface
    {
        // ...
        
        public function levelUp(): void
        {
            $this->level++;
            $this->notify();
        }
    
        public function attach(ObserverInterface $observer): void
        {
            $this->observers->attach($observer);
        }
    
        public function detach(ObserverInterface $observer): void
        {
            $this->observers->detach($observer);
        }
    
        public function notify(): void
        {
            foreach ($this->observers as $observer) {
                /** @var $observer ObserverInterface */
                $observer->update($this);
            }
        }
        
        // ...
    }

<p>
    Обратите внимание на простоту метода levelUp(); - мы просто изменяем уровень и 
    сообщаем наблюдателям, что объект изменился — дальше они уже сами решат, делать 
    ли им что-нибудь и если делать — то что.
</p>
