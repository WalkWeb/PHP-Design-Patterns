<?php

declare(strict_types=1);

namespace Patterns\Other\NullObject\Character;

use Patterns\Other\NullObject\Character\Action\ActionInterface;

class Character implements CharacterInterface
{
    /**
     * @var int
     */
    private $hp;

    /**
     * @var int
     */
    private $gold;

    public function __construct(int $hp, int $gold)
    {
        $this->hp = $hp;
        $this->gold = $gold;
    }

    public function getHp(): int
    {
        return $this->hp;
    }

    public function getGold(): int
    {
        return $this->gold;
    }

    /**
     * Применяет к персонажу игровое событие
     *
     * @uses handleTrapAction, handleGoldAction, handleNullAction
     * @param ActionInterface $action
     * @throws CharacterException
     */
    public function handleAction(ActionInterface $action): void
    {
        if (!method_exists($this, $action->handleMethod())) {
            throw new CharacterException(CharacterException::UNDEFINED_METHOD . ': '. $action->handleMethod());
        }

        $method = $action->handleMethod();

        $this->$method($action);
    }

    /**
     * Применяет действие ловушки к персонажу
     *
     * @param ActionInterface $action
     */
    private function handleTrapAction(ActionInterface $action): void
    {
        $this->hp -= $action->getPower();

        if ($this->hp < 0) {
            $this->hp = 0;
        }
    }

    /**
     * Применяет событие золота к персонажу
     *
     * @param ActionInterface $action
     */
    private function handleGoldAction(ActionInterface $action): void
    {
        $this->gold += $action->getPower();
    }

    /**
     * Null-событие - ничего не делает
     *
     * @param ActionInterface $action
     */
    private function handleNullAction(ActionInterface $action): void {}
}
