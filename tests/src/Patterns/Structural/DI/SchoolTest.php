<?php

declare(strict_types=1);

namespace Tests\Structural\DI;

use Patterns\Structural\DI\School;
use PHPUnit\Framework\TestCase;

class SchoolTest extends TestCase
{
    public function testSchoolCreate(): void
    {
        $name = 'School №123';

        $school = new School($name);

        self::assertEquals($name, $school->getName());
    }
}
