<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\helpers;

use Mnemesong\Spex\specifications\comparing\StringValueComparingSpecification;
use Mnemesong\Spex\specifications\composites\MultipleCompositeSpecification;
use Mnemesong\Spex\helpers\SpecificationConverter;
use Mnemesong\Structure\Structure;
use PHPUnit\Framework\TestCase;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class SpecificationConverterTest extends TestCase
{
    public function testConversion()
    {
        $struct = new Structure(['uuid' => '89hgaf98', 'date' => '2022-01-02', 'age' => 12]);
        $spec = SpecificationConverter::structToSpec($struct);
        $this->assertEquals(new MultipleCompositeSpecification('and', [
            new StringValueComparingSpecification('s=', 'uuid', '89hgaf98'),
            new StringValueComparingSpecification('s=', 'date', '2022-01-02'),
            new StringValueComparingSpecification('s=', 'age', '12'),
        ]), $spec);

        $struct = new Structure(['uuid' => '89hgaf98', 'date' => '2022-01-02', 'age' => 12]);
        $spec = SpecificationConverter::structToSpec($struct, 'or');
        $this->assertEquals(new MultipleCompositeSpecification('or', [
            new StringValueComparingSpecification('s=', 'uuid', '89hgaf98'),
            new StringValueComparingSpecification('s=', 'date', '2022-01-02'),
            new StringValueComparingSpecification('s=', 'age', '12'),
        ]), $spec);
    }

    public function testConversionException()
    {
        $converter = new SpecificationConverter();
        $struct = new Structure(['uuid' => '89hgaf98', 'date' => '2022-01-02', 'age' => 12]);
        $this->expectException(\InvalidArgumentException::class);
        $spec = SpecificationConverter::structToSpec($struct, 'some');
    }
}