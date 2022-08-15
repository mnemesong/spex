<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\specifications\comparing;

use Mnemesong\Spex\specifications\comparing\ColumnsComparingSpecification;
use Mnemesong\SpexUnitTest\specifications\abstracts\NonCompositeSpecificationTestTemplate;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class ColumnsComparingSpecificationTest extends NonCompositeSpecificationTestTemplate
{
    public function testBasics()
    {
        $spec = new ColumnsComparingSpecification('cs=', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cs=');
        $this->assertEquals($spec->getField1(), 'startDate');
        $this->assertEquals($spec->getField2(), 'finishDate');
    }

    public function testConstructorException1()
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new ColumnsComparingSpecification('s=', 'startDate', 'finishDate');
    }

    public function testConstructorException2()
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new ColumnsComparingSpecification('and', 'startDate', 'finishDate');
    }

    public function testIsComposite()
    {
        $spec = new ColumnsComparingSpecification('cs=', 'startDate', 'finishDate');
        $this->assertEquals($spec->isComposite(), false);
    }

    public function testGetType()
    {
        $spec = new ColumnsComparingSpecification('cs=', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cs=');
        $spec = new ColumnsComparingSpecification('cs!=', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cs!=');
        $spec = new ColumnsComparingSpecification('cs>', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cs>');
        $spec = new ColumnsComparingSpecification('cs>=', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cs>=');
        $spec = new ColumnsComparingSpecification('cs<', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cs<');
        $spec = new ColumnsComparingSpecification('cs<=', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cs<=');
        $spec = new ColumnsComparingSpecification('clike', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'clike');
        $spec = new ColumnsComparingSpecification('cn=', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cn=');
        $spec = new ColumnsComparingSpecification('cn!=', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cn!=');
        $spec = new ColumnsComparingSpecification('cn>', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cn>');
        $spec = new ColumnsComparingSpecification('cn>=', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cn>=');
        $spec = new ColumnsComparingSpecification('cn<', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cn<');
        $spec = new ColumnsComparingSpecification('cn<=', 'startDate', 'finishDate');
        $this->assertEquals($spec->getType(), 'cn<=');
    }

    public function testIsUnary()
    {
        $spec = new ColumnsComparingSpecification('cs=', 'startDate', 'finishDate');
        $this->assertEquals($spec->isUnary(), false);
    }

    public function testIsValueComparing()
    {
        $spec = new ColumnsComparingSpecification('cs=', 'startDate', 'finishDate');
        $this->assertEquals($spec->isValueComparing(), false);
    }

    public function testIsFieldsComparing()
    {
        $spec = new ColumnsComparingSpecification('cs=', 'startDate', 'finishDate');
        $this->assertEquals($spec->isFieldsComparing(), true);
    }

    public function testIsArrayComparing()
    {
        $spec = new ColumnsComparingSpecification('cs=', 'startDate', 'finishDate');
        $this->assertEquals($spec->isArrayComparing(), false);
    }
}