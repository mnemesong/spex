<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\specifications\comparing;

use Mnemesong\Spex\specifications\comparing\NumericValueComparingSpecification;
use Mnemesong\SpexUnitTest\specifications\abstracts\NonCompositeSpecificationTestTemplate;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class NumericValueComparingSpecificationTest extends NonCompositeSpecificationTestTemplate
{
    public function testBasics1()
    {
        $spec = new NumericValueComparingSpecification('n<', 'age', 22);
        $this->assertEquals($spec->getType(), 'n<');
        $this->assertEquals($spec->getField(), 'age');
        $this->assertEquals($spec->getValue(), 22);
    }

    public function testBasics2()
    {
        $spec = new NumericValueComparingSpecification('n>=', 'age', 22.11);
        $this->assertEquals($spec->getType(), 'n>=');
        $this->assertEquals($spec->getField(), 'age');
        $this->assertEquals($spec->getValue(), 22.11);
    }

    public function testConstructException1()
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new NumericValueComparingSpecification('in', 'age', 22);
    }

    public function testConstructException2()
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new NumericValueComparingSpecification('or', 'age', 22);
    }

    public function testConstructException4()
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new NumericValueComparingSpecification('or', 'age', 11.11);
    }

    public function testIsComposite()
    {
        $spec = new NumericValueComparingSpecification('n<', 'age', 22);
        $this->assertEquals($spec->isComposite(), false);
    }

    public function testGetType()
    {
        $spec = new NumericValueComparingSpecification('n=', 'age', 22);
        $this->assertEquals($spec->getType(), 'n=');
        $spec = new NumericValueComparingSpecification('n!=', 'age', 22);
        $this->assertEquals($spec->getType(), 'n!=');
        $spec = new NumericValueComparingSpecification('n<=', 'age', 22);
        $this->assertEquals($spec->getType(), 'n<=');
        $spec = new NumericValueComparingSpecification('n<', 'age', 22);
        $this->assertEquals($spec->getType(), 'n<');
        $spec = new NumericValueComparingSpecification('n!<', 'age', 22);
        $this->assertEquals($spec->getType(), 'n!<');
        $spec = new NumericValueComparingSpecification('n>=', 'age', 22);
        $this->assertEquals($spec->getType(), 'n>=');
        $spec = new NumericValueComparingSpecification('n>', 'age', 22);
        $this->assertEquals($spec->getType(), 'n>');
        $spec = new NumericValueComparingSpecification('n!>', 'age', 22);
        $this->assertEquals($spec->getType(), 'n!>');
    }

    public function testIsUnary()
    {
        $spec = new NumericValueComparingSpecification('n<', 'age', 22);
        $this->assertEquals($spec->isUnary(), false);
    }

    public function testIsValueComparing()
    {
        $spec = new NumericValueComparingSpecification('n<', 'age', 22);
        $this->assertEquals($spec->isValueComparing(), true);
    }

    public function testIsFieldsComparing()
    {
        $spec = new NumericValueComparingSpecification('n<', 'age', 22);
        $this->assertEquals($spec->isFieldsComparing(), false);
    }

    public function testIsArrayComparing()
    {
        $spec = new NumericValueComparingSpecification('n<', 'age', 22);
        $this->assertEquals($spec->isArrayComparing(), false);
    }

    public function testNumericComparing()
    {
        $spec = new NumericValueComparingSpecification('n<', 'age', 22);
        $this->assertEquals($spec->isNumericComparing(), true);
    }

    public function testStringComparing()
    {
        $spec = new NumericValueComparingSpecification('n<', 'age', 22);
        $this->assertEquals($spec->isStringComparing(), false);
    }
}