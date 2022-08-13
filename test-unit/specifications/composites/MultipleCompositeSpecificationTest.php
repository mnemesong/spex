<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\specifications\composites;

use Mnemesong\Spex\specifications\comparing\ArrayComparingSpecification;
use Mnemesong\Spex\specifications\comparing\NumericValueComparingSpecification;
use Mnemesong\Spex\specifications\composites\MultipleCompositeSpecification;
use Mnemesong\SpexUnitTest\specifications\abstracts\CompositeSpecificationTestTemplate;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class MultipleCompositeSpecificationTest extends CompositeSpecificationTestTemplate
{

    public function testBasics()
    {
        $spec = new MultipleCompositeSpecification('and', [
            new NumericValueComparingSpecification('n>', 'age', 18),
            new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola'])
        ]);
        $this->assertEquals($spec->getType(), 'and');
        $this->assertEquals($spec->getSpecifications(), [
            new NumericValueComparingSpecification('n>', 'age', 18),
            new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola'])
        ]);
    }

    public function testConstructExceptions1()
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new MultipleCompositeSpecification('=', [
            new NumericValueComparingSpecification('n>', 'age', 18),
            new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola'])
        ]);
    }

    public function testConstructExceptions2()
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new MultipleCompositeSpecification('in', [
            new NumericValueComparingSpecification('n>', 'age', 18),
            new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola'])
        ]);
    }

    public function testConstructExceptions3()
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new MultipleCompositeSpecification('and', [
            new NumericValueComparingSpecification('n>', 'age', 18),
        ]);
    }

    public function testIsComposite()
    {
        $spec = new MultipleCompositeSpecification('and', [
            new NumericValueComparingSpecification('n>', 'age', 18),
            new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola'])
        ]);
        $this->assertEquals($spec->isComposite(), true);
    }

    public function testGetType()
    {
        $spec = new MultipleCompositeSpecification('and', [
            new NumericValueComparingSpecification('n>', 'age', 18),
            new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola'])
        ]);
        $this->assertEquals($spec->getType(), 'and');
        $spec = new MultipleCompositeSpecification('or', [
            new NumericValueComparingSpecification('n>', 'age', 18),
            new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola'])
        ]);
        $this->assertEquals($spec->getType(), 'or');
    }

    public function testCount()
    {
        $spec = new MultipleCompositeSpecification('and', [
            new NumericValueComparingSpecification('n>', 'age', 18),
            new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola'])
        ]);
        $this->assertEquals($spec->count(), 2);
        $spec = new MultipleCompositeSpecification('or', [
            new NumericValueComparingSpecification('n>', 'age', 18),
            new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola']),
            new NumericValueComparingSpecification('n>', 'seconds', 153),
            new MultipleCompositeSpecification('or', [
                new NumericValueComparingSpecification('n>', 'year', 1852),
                new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola']),
            ])
        ]);
        $this->assertEquals($spec->count(), 4);
    }

    public function testIsMultiple()
    {
        $spec = new MultipleCompositeSpecification('and', [
            new NumericValueComparingSpecification('n>', 'age', 18),
            new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola'])
        ]);
        $this->assertEquals($spec->isMultiple(), true);
    }

    public function testIsUnary()
    {
        $spec = new MultipleCompositeSpecification('and', [
            new NumericValueComparingSpecification('n>', 'age', 18),
            new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola'])
        ]);
        $this->assertEquals($spec->isUnary(), false);
    }
}