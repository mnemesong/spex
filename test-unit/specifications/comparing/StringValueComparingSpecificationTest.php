<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\specifications\comparing;

use Mnemesong\Spex\specifications\comparing\StringValueComparingSpecification;
use Mnemesong\SpexUnitTest\specifications\abstracts\NonCompositeSpecificationTestTemplate;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class StringValueComparingSpecificationTest extends NonCompositeSpecificationTestTemplate
{
    public function testBasics()
    {
        $spec = new StringValueComparingSpecification('s<', 'date', '2021-05-25');
        $this->assertEquals($spec->getType(), 's<');
        $this->assertEquals($spec->getField(), 'date');
        $this->assertEquals($spec->getValue(), '2021-05-25');
    }

    public function testConstructException1()
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new StringValueComparingSpecification('in', 'date', '2021-05-25');
    }

    public function testConstructException2()
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new StringValueComparingSpecification('or', 'date', '2021-05-25');
    }

    public function testIsComposite()
    {
        $spec = new StringValueComparingSpecification('s<', 'date', '2021-05-25');
        $this->assertEquals($spec->isComposite(), false);
    }

    public function testGetType()
    {
        $spec = new StringValueComparingSpecification('s=', 'date', '2021-05-25');
        $this->assertEquals($spec->getType(), 's=');
        $spec = new StringValueComparingSpecification('s!=', 'date', '2021-05-25');
        $this->assertEquals($spec->getType(), 's!=');
        $spec = new StringValueComparingSpecification('s<', 'date', '2021-05-25');
        $this->assertEquals($spec->getType(), 's<');
        $spec = new StringValueComparingSpecification('s>', 'date', '2021-05-25');
        $this->assertEquals($spec->getType(), 's>');
        $spec = new StringValueComparingSpecification('s<=', 'date', '2021-05-25');
        $this->assertEquals($spec->getType(), 's<=');
        $spec = new StringValueComparingSpecification('s>=', 'date', '2021-05-25');
        $this->assertEquals($spec->getType(), 's>=');
        $spec = new StringValueComparingSpecification('like', 'date', '2021-05-25');
        $this->assertEquals($spec->getType(), 'like');
    }

    public function testIsUnary()
    {
        $spec = new StringValueComparingSpecification('s=', 'date', '2021-05-25');
        $this->assertEquals($spec->isUnary(), false);
    }

    public function testIsValueComparing()
    {
        $spec = new StringValueComparingSpecification('s=', 'date', '2021-05-25');
        $this->assertEquals($spec->isValueComparing(), true);
    }

    public function testIsFieldsComparing()
    {
        $spec = new StringValueComparingSpecification('s=', 'date', '2021-05-25');
        $this->assertEquals($spec->isFieldsComparing(), false);
    }

    public function testIsArrayComparing()
    {
        $spec = new StringValueComparingSpecification('s=', 'date', '2021-05-25');
        $this->assertEquals($spec->isArrayComparing(), false);
    }

    public function testNumericComparing()
    {
        $spec = new StringValueComparingSpecification('s=', 'date', '2021-05-25');
        $this->assertEquals($spec->isNumericComparing(), false);
    }

    public function testStringComparing()
    {
        $spec = new StringValueComparingSpecification('s=', 'date', '2021-05-25');
        $this->assertEquals($spec->isStringComparing(), true);
    }
}