<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\specifications\comparing;

use Mnemesong\Spex\specifications\comparing\ArrayComparingSpecification;
use Mnemesong\SpexUnitTest\specifications\abstracts\NonCompositeSpecificationTestTemplate;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class ArrayComparingSpecificationTest extends NonCompositeSpecificationTestTemplate
{
    public function testBasics()
    {
        $spec = new ArrayComparingSpecification('in', 'date', ['2022-12-01, 2022-11-13']);
        $this->assertEquals($spec->getType(), 'in');
        $this->assertEquals($spec->getValue(), ['2022-12-01, 2022-11-13']);
        $this->assertEquals($spec->getField(), 'date');
    }

    public function testConstructorTypeException1()
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new ArrayComparingSpecification('c!=', 'date', ['2022-12-01, 2022-11-13']);
    }

    public function testConstructorTypeException2()
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new ArrayComparingSpecification('and', 'date', ['2022-12-01, 2022-11-13']);
    }

    public function testConstructorTypeException3()
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new ArrayComparingSpecification('=', 'date', ['2022-12-01, 2022-11-13']);
    }


    public function testIsComposite()
    {
        $spec = new ArrayComparingSpecification('in', 'date', ['2022-12-01, 2022-11-13']);
        $this->assertEquals($spec->isComposite(), false);
    }

    public function testGetType()
    {
        $spec = new ArrayComparingSpecification('in', 'date', ['2022-12-01, 2022-11-13']);
        $this->assertEquals($spec->getType(), 'in');
    }

    public function testIsUnary()
    {
        $spec = new ArrayComparingSpecification('in', 'date', ['2022-12-01, 2022-11-13']);
        $this->assertEquals($spec->isUnary(), false);
    }

    public function testIsValueComparing()
    {
        $spec = new ArrayComparingSpecification('in', 'date', ['2022-12-01, 2022-11-13']);
        $this->assertEquals($spec->isValueComparing(), false);
    }

    public function testIsFieldsComparing()
    {
        $spec = new ArrayComparingSpecification('in', 'date', ['2022-12-01, 2022-11-13']);
        $this->assertEquals($spec->isFieldsComparing(), false);
    }

    public function testIsArrayComparing()
    {
        $spec = new ArrayComparingSpecification('in', 'date', ['2022-12-01, 2022-11-13']);
        $this->assertEquals($spec->isArrayComparing(), true);
    }
}