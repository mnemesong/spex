<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\specifications\comparing;

use Mnemesong\Spex\specifications\comparing\NumericValueComparingSpecification;
use Mnemesong\SpexUnitTest\specifications\abstracts\AbstractSpecificationTestTemplate;
use Mnemesong\SpexUnitTest\specifications\abstracts\NonCompositeSpecificationTestTemplate;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class NumericValueComparingSpecificationTest extends AbstractSpecificationTestTemplate
{
    public function testBasics1(): void
    {
        $spec = new NumericValueComparingSpecification('n<', 'age', 22);
        $this->assertEquals($spec->getType(), 'n<');
        $this->assertEquals($spec->getField(), 'age');
        $this->assertEquals($spec->getValue(), 22);
    }

    public function testBasics2(): void
    {
        $spec = new NumericValueComparingSpecification('n>=', 'age', 22.11);
        $this->assertEquals($spec->getType(), 'n>=');
        $this->assertEquals($spec->getField(), 'age');
        $this->assertEquals($spec->getValue(), 22.11);
    }

    public function testConstructException1(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new NumericValueComparingSpecification('in', 'age', 22);
    }

    public function testConstructException2(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new NumericValueComparingSpecification('or', 'age', 22);
    }

    public function testConstructException4(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new NumericValueComparingSpecification('or', 'age', 11.11);
    }

    public function testGetType(): void
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
}