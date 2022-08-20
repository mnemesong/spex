<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\specifications\comparing;

use Mnemesong\Spex\specifications\abstracts\SpecificationTrait;
use Mnemesong\Spex\specifications\comparing\ArrayComparingSpecification;
use Mnemesong\Spex\specifications\comparing\ColumnsComparingSpecification;
use Mnemesong\SpexUnitTest\specifications\abstracts\SpecificationTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class ColumnsComparingSpecificationTest extends TestCase
{
    use SpecificationTestTrait;

    /**
     * @return void
     */
    public function testBasics(): void
    {
        $spec = new ColumnsComparingSpecification('cs=', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cs=');
        $this->assertEquals($spec->getField1(), 'startDate');
        $this->assertEquals($spec->getField2(), 'finishDate');
    }

    /**
     * @return void
     */
    public function testConstructorException1(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new ColumnsComparingSpecification('s=', 'startDate', 'finishDate');
    }

    /**
     * @return void
     */
    public function testConstructorException2(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new ColumnsComparingSpecification('and', 'startDate', 'finishDate');
    }

    /**
     * @return void
     */
    public function testGetType(): void
    {
        $spec = new ColumnsComparingSpecification('cs=', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cs=');
        $spec = new ColumnsComparingSpecification('cs!=', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cs!=');
        $spec = new ColumnsComparingSpecification('cs>', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cs>');
        $spec = new ColumnsComparingSpecification('cs!>', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cs!>');
        $spec = new ColumnsComparingSpecification('cs>=', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cs>=');
        $spec = new ColumnsComparingSpecification('cs<', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cs<');
        $spec = new ColumnsComparingSpecification('cs!<', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cs!<');
        $spec = new ColumnsComparingSpecification('cs<=', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cs<=');
        $spec = new ColumnsComparingSpecification('clike', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'clike');
        $spec = new ColumnsComparingSpecification('c!like', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'c!like');
        $spec = new ColumnsComparingSpecification('cn=', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cn=');
        $spec = new ColumnsComparingSpecification('cn!=', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cn!=');
        $spec = new ColumnsComparingSpecification('cn>', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cn>');
        $spec = new ColumnsComparingSpecification('cn!>', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cn!>');
        $spec = new ColumnsComparingSpecification('cn>=', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cn>=');
        $spec = new ColumnsComparingSpecification('cn<', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cn<');
        $spec = new ColumnsComparingSpecification('cn!<', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cn!<');
        $spec = new ColumnsComparingSpecification('cn<=', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cn<=');
    }

    /**
     * @return void
     */
    public function testAssertClass(): void
    {
        $spec = new ColumnsComparingSpecification('cs=', 'startDate', 'finishDate');
        $spec = ColumnsComparingSpecification::assertClass($spec);
        $this->assertTrue(is_a($spec, ColumnsComparingSpecification::class));
    }

    /**
     * @return void
     */
    public function testAssertClassException(): void
    {
        $spec = new ArrayComparingSpecification('!in', 'name', ['John']);
        $this->expectException(\InvalidArgumentException::class);
        $spec = ColumnsComparingSpecification::assertClass($spec);
    }
}