<?php

declare(strict_types=1);

namespace Tests\Structural\Facade;

use Patterns\Structural\Facade\Facade;
use src\AbstractUnitTest;

class FacadeTest extends AbstractUnitTest
{
    public function testFacadeGetRecommendation(): void
    {
        self::assertEquals(
            'Рекомендуемый автор: Джордж Р. Р. Мартин, рекомендуемая книга автора: Песнь Льда и Пламени, купить рядом с вами в магазине Amazon',
            Facade::getRecommendation()
        );
    }
}
