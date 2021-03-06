<?php

declare(strict_types = 1);

/**
 * This file is part of the jordanbrauer/unit-converter PHP package.
 *
 * @copyright 2018 Jordan Brauer <18744334+jordanbrauer@users.noreply.github.com>
 * @license MIT
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UnitConverter\Tests\Integration\Unit\Time;

use PHPUnit\Framework\TestCase;
use UnitConverter\Calculator\SimpleCalculator;
use UnitConverter\Registry\UnitRegistry;
use UnitConverter\Unit\Time\Second;
use UnitConverter\Unit\Time\Year;
use UnitConverter\UnitConverter;

/**
 * Ensure that a year is infact, a year.
 *
 * @covers UnitConverter\Unit\Time\Year
 * @uses UnitConverter\Support\ArrayDotNotation
 * @uses UnitConverter\Support\Collection
 * @uses UnitConverter\Unit\Time\Second
 * @uses UnitConverter\Unit\AbstractUnit
 * @uses UnitConverter\UnitConverter
 * @uses UnitConverter\Calculator\SimpleCalculator
 * @uses UnitConverter\Calculator\AbstractCalculator
 * @uses UnitConverter\Calculator\Formula\AbstractFormula
 * @uses UnitConverter\Calculator\Formula\UnitConversionFormula
 * @uses UnitConverter\Registry\UnitRegistry
 */
class YearSpec extends TestCase
{
    protected function setUp()
    {
        $this->converter = new UnitConverter(
            new UnitRegistry([
                new Second(),
                new Year(),
            ]),
            new SimpleCalculator()
        );
    }

    protected function tearDown()
    {
        unset($this->converter);
    }

    /**
     * @test
     */
    public function assert1YearIs31536000Seconds()
    {
        $expected = 31536000;
        $actual = $this->converter
            ->convert(1)
            ->from("y")
            ->to("s");

        $this->assertEquals($expected, $actual);
    }

    /**
     * @test
     * @return void
     */
    public function assertLeapYearsAreProperlyDetected(): void
    {
        $leapYears = [2000, 2004, 2008, 2012, 2016, 2020];
        foreach ($leapYears as $leapYear) {
            $this->assertTrue(Year::isLeapYear($leapYear));
        }

        $regularYears = array_diff(range(2000, 2020), $leapYears);
        $regularYears = array_merge($regularYears, [1800, 1900, 2100, 2200, 2300, 2500]);
        foreach ($regularYears as $year) {
            $this->assertFalse(Year::isLeapYear($year));
        }
    }
}
