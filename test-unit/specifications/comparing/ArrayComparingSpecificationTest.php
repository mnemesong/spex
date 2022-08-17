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
    public function testBasics(): void
    {
        $spec = new ArrayComparingSpecification('in', 'date', ['2022-12-01, 2022-11-13']);
        $this->assertEquals($spec->getType(), 'in');
        $this->assertEquals($spec->getValue(), ['2022-12-01, 2022-11-13']);
        $this->assertEquals($spec->getField(), 'date');
    }

    public function testConstructorTypeException1(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new ArrayComparingSpecification('c!=', 'date', ['2022-12-01, 2022-11-13']);
    }

    public function testConstructorTypeException2(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new ArrayComparingSpecification('and', 'date', ['2022-12-01, 2022-11-13']);
    }

    public function testConstructorTypeException3(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new ArrayComparingSpecification('=', 'date', ['2022-12-01, 2022-11-13']);
    }


    public function testIsComposite(): void
    {
        $spec = new ArrayComparingSpecification('in', 'date', ['2022-12-01, 2022-11-13']);
        $this->assertEquals($spec->isComposite(), false);
    }

    public function testGetType(): void
    {
        $spec = new ArrayComparingSpecification('in', 'date', ['2022-12-01, 2022-11-13']);
        $this->assertEquals($spec->getType(), 'in');
        $spec = new ArrayComparingSpecification('!in', 'date', ['2022-12-01, 2022-11-13']);
        $this->assertEquals($spec->getType(), '!in');
    }

    public function testIsUnary(): void
    {
        $spec = new ArrayComparingSpecification('in', 'date', ['2022-12-01, 2022-11-13']);
        $this->assertEquals($spec->isUnary(), false);
    }

    public function testIsValueComparing(): void
    {
        $spec = new ArrayComparingSpecification('in', 'date', ['2022-12-01, 2022-11-13']);
        $this->assertEquals($spec->isValueComparing(), false);
    }

    public function testIsFieldsComparing(): void
    {
        $spec = new ArrayComparingSpecification('in', 'date', ['2022-12-01, 2022-11-13']);
        $this->assertEquals($spec->isFieldsComparing(), false);
    }

    public function testIsArrayComparing(): void
    {
        $spec = new ArrayComparingSpecification('in', 'date', ['2022-12-01, 2022-11-13']);
        $this->assertEquals($spec->isArrayComparing(), true);
    }
}