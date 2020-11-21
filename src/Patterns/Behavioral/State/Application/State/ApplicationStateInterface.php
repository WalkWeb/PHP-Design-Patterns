<?php

declare(strict_types=1);

namespace Patterns\Behavioral\State\Application\State;

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
