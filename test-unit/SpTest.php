<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest;

use Mnemesong\Spex\Sp;
use Mnemesong\Spex\specifications\comparing\ArrayComparingSpecification;
use Mnemesong\Spex\specifications\comparing\ColumnsComparingSpecification;
use Mnemesong\Spex\specifications\comparing\NumericValueComparingSpecification;
use Mnemesong\Spex\specifications\comparing\StringValueComparingSpecification;
use Mnemesong\Spex\specifications\comparing\UnaryValueSpecification;
use Mnemesong\Spex\specifications\composites\MultipleCompositeSpecification;
use Mnemesong\Spex\specifications\composites\UnaryCompositeSpecification;
use PHPUnit\Framework\TestCase;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class SpTest extends TestCase
{
    public function testArrayComparingSpecificationBuild()
    {
        $spec = Sp::ex('in', 'age', [20,22,24,26]);
        $this->assertEquals($spec, new ArrayComparingSpecification('in', 'age', [20,22,24,26]));
    }

    public function testFieldsComparingSpecification()
    {
        $spec = Sp::ex('c!=', 'date', 'date2');
        $this->assertEquals($spec, new ColumnsComparingSpecification('c!=', 'date', 'date2'));

        $spec = (new Sp())->express('c>', 'date', 'date2');
        $this->assertEquals($spec, new ColumnsComparingSpecification('c>', 'date', 'date2'));
    }

    public function testNumericValueComparingSpecification()
    {
        $spec = Sp::ex('n>', 'age', 21);
        $this->assertEquals($spec, new NumericValueComparingSpecification('n>', 'age', 21));

        $spec = (new Sp)->express('n!=', 'count', 22);
        $this->assertEquals($spec, new NumericValueComparingSpecification('n!=', 'count', 22));
    }

    public function testStringValueSpecificationsBuild()
    {
        $spec = Sp::ex('s=', 'age', 18);
        $this->assertEquals($spec, new StringValueComparingSpecification('s=', 'age', '18'));

        $spec = (new Sp)->express('s>', 'date', '2022-11-03');
        $this->assertEquals($spec, new StringValueComparingSpecification('s>', 'date', '2022-11-03'));
    }

    public function testUnaryValueSpecificationBuild()
    {
        $spec = Sp::ex('null', 'responsible');
        $this->assertEquals($spec, new UnaryValueSpecification('null', 'responsible'));

        $spec = (new Sp())->express('!empty', 'customer');
        $this->assertEquals($spec, new UnaryValueSpecification('!empty', 'customer'));
    }

    public function testMultipleCompositeSpecificationBuild()
    {
        $spec = Sp::ex('and', [
            Sp::ex('null', 'responsible'),
            Sp::ex('s=', 'age', 18),
            Sp::ex('c!=', 'date', 'date2'),
        ]);
        $this->assertEquals($spec, new MultipleCompositeSpecification('and', [
            new UnaryValueSpecification('null', 'responsible'),
            new StringValueComparingSpecification('s=', 'age', '18'),
            new ColumnsComparingSpecification('c!=', 'date', 'date2'),
        ]));

        $sp = new Sp();
        $spec = $sp->express('or', [
            Sp::ex('null', 'responsible'), Sp::ex('s=', 'age', '18')
        ]);
        $this->assertEquals($spec, new MultipleCompositeSpecification('or', [
            new UnaryValueSpecification('null', 'responsible'),
            new StringValueComparingSpecification('s=', 'age', '18'),
        ]));
    }

    public function testUnaryCompositeSpecificationBuild()
    {
        $spec = Sp::ex('!', Sp::ex('s=', 'age', '18'));
        $this->assertEquals($spec, new UnaryCompositeSpecification('!',
            new StringValueComparingSpecification('s=', 'age', '18')));
    }

}