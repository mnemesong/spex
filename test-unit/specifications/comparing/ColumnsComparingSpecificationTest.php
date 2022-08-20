<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\specifications\comparing;

use Mnemesong\Spex\specifications\comparing\ColumnsComparingSpecification;
use Mnemesong\SpexUnitTest\specifications\abstracts\AbstractSpecificationTestTemplate;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class ColumnsComparingSpecificationTest extends AbstractSpecificationTestTemplate
{
    public function testBasics(): void
    {
        $spec = new ColumnsComparingSpecification('cs=', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cs=');
        $this->assertEquals($spec->getField1(), 'startDate');
        $this->assertEquals($spec->getField2(), 'finishDate');
    }

    public function testConstructorException1(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new ColumnsComparingSpecification('s=', 'startDate', 'finishDate');
    }

    public function testConstructorException2(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new ColumnsComparingSpecification('and', 'startDate', 'finishDate');
    }

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

}