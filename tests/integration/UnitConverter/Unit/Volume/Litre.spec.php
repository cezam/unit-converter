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

namespace UnitConverter\Tests\Integration\Unit\Volume;

use Iterator;
use UnitConverter\Tests\TestCase;
use UnitConverter\Unit\Volume\CubicMetre;
use UnitConverter\Unit\Volume\Gallon;
use UnitConverter\Unit\Volume\Litre;
use UnitConverter\Unit\Volume\Millilitre;
use UnitConverter\Unit\Volume\Pint;
use UnitConverter\UnitConverter;

/**
 * Ensure that a litre is litre.
 *
 * @covers UnitConverter\Unit\Volume\Litre
 * @uses UnitConverter\Unit\AbstractUnit
 * @uses UnitConverter\UnitConverter
 * @uses UnitConverter\Calculator\SimpleCalculator
 * @uses UnitConverter\Calculator\AbstractCalculator
 * @uses UnitConverter\Calculator\Formula\AbstractFormula
 * @uses UnitConverter\Calculator\Formula\UnitConversionFormula
 * @uses UnitConverter\Registry\UnitRegistry
 * @uses UnitConverter\Support\ArrayDotNotation
 * @uses UnitConverter\Support\Collection
 */
class LitreSpec extends TestCase
{
    public function correctConversions(): Iterator
    {
        $l = new Litre();

        yield from [
            '1 litre is equal to 0.001 cubic metres' => [1, $l, 0.001, new CubicMetre(), 3],
            '1 litre is equal to 0.264172 gallons'   => [1, $l, 0.264172, new Gallon(), 6],
            '1 litre is equal to 1 litre'            => [1, $l, 1.0, new Litre(), 0],
            '1 litre is equal to 1000 millilitres'   => [1, $l, 1000.0, new Millilitre(), 0],
            '1 litre is equal to 2.11338 pints'      => [1, $l, 2.11338, new Pint(), 5],
        ];
    }
}
