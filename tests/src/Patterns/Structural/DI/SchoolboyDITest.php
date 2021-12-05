<?php

declare(strict_types=1);

namespace Tests\Structural\DI;

use Patterns\Structural\DI\School;
use Patterns\Structural\DI\SchoolboyDI;
use PHPUnit\Framework\TestCase;

class SchoolboyDITest extends TestCase
{
    public function testSchoolboyDICreate(): void
    {
        $schoolName = 'School №505';
        $school = new School($schoolName);

        $schoolboyName = 'Maria';
        $schoolboy = new SchoolboyDI($schoolboyName, $school);

        self::assertEquals($schoolboyName, $schoolboy->getName());
        self::assertEquals($schoolName, $schoolboy->getSchoolName());
    }
}
