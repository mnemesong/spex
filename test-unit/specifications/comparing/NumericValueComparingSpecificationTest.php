<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\specifications\comparing;

use Mnemesong\Spex\specifications\abstracts\SpecificationTrait;
use Mnemesong\Spex\specifications\comparing\ColumnsComparingSpecification;
use Mnemesong\Spex\specifications\comparing\NumericValueComparingSpecification;
use Mnemesong\SpexUnitTest\specifications\abstracts\SpecificationTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class NumericValueComparingSpecificationTest extends TestCase
{
    use SpecificationTestTrait;

    /**
     * @return void
     */
    public function testBasics1(): void
    {
        $spec = new NumericValueComparingSpecification('n<', 'age', 22);
        $this->assertEquals($spec->getType(), 'n<');
        $this->assertEquals($spec->getField(), 'age');
        $this->assertEquals($spec->getValue(), 22);
    }

    /**
     * @return void
     */
    public function testBasics2(): void
    {
        $spec = new NumericValueComparingSpecification('n>=', 'age', 22.11);
        $this->assertEquals($spec->getType(), 'n>=');
        $this->assertEquals($spec->getField(), 'age');
        $this->assertEquals($spec->getValue(), 22.11);
    }

    /**
     * @return void
     */
    public function testConstructException1(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new NumericValueComparingSpecification('in', 'age', 22);
    }

    /**
     * @return void
     */
    public function testConstructException2(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new NumericValueComparingSpecification('or', 'age', 22);
    }

    /**
     * @return void
     */
    public function testConstructException4(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new NumericValueComparingSpecification('or', 'age', 11.11);
    }

    /**
     * @return void
     */
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

    /**
     * @return void
     */
    public function testAssertClass(): void
    {
        $spec = new NumericValueComparingSpecification('n>', 'age', 12);
        $spec = NumericValueComparingSpecification::assertClass($spec);
        $this->assertTrue(is_a($spec, NumericValueComparingSpecification::class));
    }

    /**
     * @return void
     */
    public function testAssertClassException(): void
    {
        $spec = new ColumnsComparingSpecification('cs=', 'name', 'account');
        $this->expectException(\InvalidArgumentException::class);
        $spec = NumericValueComparingSpecification::assertClass($spec);
    }
}