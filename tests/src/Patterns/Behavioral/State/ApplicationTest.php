<?php

declare(strict_types=1);

namespace Tests\Behavioral\State;

use Patterns\Behavioral\State\Application\Application;
use Patterns\Behavioral\State\Application\State\ApplicationStateException;
use Patterns\Behavioral\State\Application\State\ApplicationStateInterface;
use PHPUnit\Framework\TestCase;

/**
 * В тестах проверены все успешные и неуспешные переходы заявки из одного статуса в другой:
 *
 * (New) => (Start)
 * (New) x  (End)
 * (New) => (Closed)
 *
 * (Start) x  (New)
 * (Start) => (End)
 * (Start) => (Closed)
 *
 * (End) x  (New)
 * (End) => (Start)
 * (End) => (Closed)
 *
 * (Closed) => (New)
 * (Closed) x  (Start)
 * (Closed) x  (End)
 *
 * @package Tests\State
 */
class ApplicationTest extends TestCase
{
    /**
     * Вариант обработки заявки по умолчанию
     *
     * Обратите внимание, что одно и тоже обращение к методу $application->singUp() в разных состояниях заявки приводит
     * к разному результату
     *
     * @throws ApplicationStateException
     */
    public function testHandleApplication(): void
    {
        $application = new Application();

        self::assertEquals(ApplicationStateInterface::SING_UP_NEW, $application->singUp());
        self::assertEquals(ApplicationStateInterface::AUCTION_START, $application->auctionStart());
        self::assertEquals(ApplicationStateInterface::SING_UP_START, $application->singUp());
        self::assertEquals(ApplicationStateInterface::AUCTION_END, $application->auctionEnd());
        self::assertEquals(ApplicationStateInterface::AUCTION_CLOSED, $application->auctionClosed());
    }

    /**
     * Тест успешного перехода заявки из статуса closed в статус new
     *
     * @throws ApplicationStateException
     */
    public function testApplicationReopened(): void
    {
        $application = new Application();
        $application->auctionStart();
        $application->auctionEnd();
        $application->auctionClosed();

        self::assertEquals(ApplicationStateInterface::AUCTION_NEW, $application->auctionNew());
    }

    /**
     * Тест успешного перехода заявки из статуса new в статус closed
     *
     * @throws ApplicationStateException
     */
    public function testApplicationOnceClosed(): void
    {
        $application = new Application();

        self::assertEquals(ApplicationStateInterface::AUCTION_CLOSED, $application->auctionClosed());
    }

    /**
     * Тест успешного перехода заявки из статуса start в статус closed
     *
     * @throws ApplicationStateException
     */
    public function testApplicationStartToClosed(): void
    {
        $application = new Application();
        $application->auctionStart();

        self::assertEquals(ApplicationStateInterface::AUCTION_CLOSED, $application->auctionClosed());
    }

    /**
     * Тест успешного перехода заявки из статуса end в статус start
     *
     * @throws ApplicationStateException
     */
    public function testApplicationEndToStart(): void
    {
        $application = new Application();
        $application->auctionStart();
        $application->auctionEnd();

        self::assertEquals(ApplicationStateInterface::AUCTION_START, $application->auctionStart());
    }

    /**
     * Тест неуспешного перехода заявки из статуса new в статус end
     *
     * @throws ApplicationStateException
     */
    public function testApplicationNewToEndFail(): void
    {
        $application = new Application();

        $this->expectException(ApplicationStateException::class);
        $application->auctionEnd();
    }

    /**
     * Тест неуспешного перехода заявки из статуса start в статус new
     *
     * @throws ApplicationStateException
     */
    public function testApplicationStartToNewFail(): void
    {
        $application = new Application();
        $application->auctionStart();

        $this->expectException(ApplicationStateException::class);
        $application->auctionNew();
    }

    /**
     * Тест неуспешного перехода заявки из статуса end в статус new
     *
     * @throws ApplicationStateException
     */
    public function testApplicationEndToNewFail(): void
    {
        $application = new Application();
        $application->auctionStart();
        $application->auctionEnd();

        $this->expectException(ApplicationStateException::class);
        $application->auctionNew();
    }

    /**
     * Тест неуспешного перехода заявки из статуса closed в статус start
     *
     * @throws ApplicationStateException
     */
    public function testApplicationCloseToStartFail(): void
    {
        $application = new Application();
        $application->auctionStart();
        $application->auctionEnd();
        $application->auctionClosed();

        $this->expectException(ApplicationStateException::class);
        $application->auctionStart();
    }

    /**
     * Тест неуспешного перехода заявки из статуса closed в статус end
     *
     * @throws ApplicationStateException
     */
    public function testApplicationCloseToEndFail(): void
    {
        $application = new Application();
        $application->auctionStart();
        $application->auctionEnd();
        $application->auctionClosed();

        $this->expectException(ApplicationStateException::class);
        $application->auctionEnd();
    }
}
