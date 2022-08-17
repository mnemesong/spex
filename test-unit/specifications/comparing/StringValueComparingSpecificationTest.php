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
    public function testBasics(): void
    {
        $spec = new StringValueComparingSpecification('s<', 'date', '2021-05-25');
        $this->assertEquals($spec->getType(), 's<');
        $this->assertEquals($spec->getField(), 'date');
        $this->assertEquals($spec->getValue(), '2021-05-25');
    }

    public function testConstructException1(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new StringValueComparingSpecification('in', 'date', '2021-05-25');
    }

    public function testConstructException2(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new StringValueComparingSpecification('or', 'date', '2021-05-25');
    }

    public function testIsComposite(): void
    {
        $spec = new StringValueComparingSpecification('s<', 'date', '2021-05-25');
        $this->assertEquals($spec->isComposite(), false);
    }

    public function testGetType(): void
    {
        $spec = new StringValueComparingSpecification('s=', 'date', '2021-05-25');
        $this->assertEquals($spec->getType(), 's=');
        $spec = new StringValueComparingSpecification('s!=', 'date', '2021-05-25');
        $this->assertEquals($spec->getType(), 's!=');
        $spec = new StringValueComparingSpecification('s<', 'date', '2021-05-25');
        $this->assertEquals($spec->getType(), 's<');
        $spec = new StringValueComparingSpecification('s!<', 'date', '2021-05-25');
        $this->assertEquals($spec->getType(), 's!<');
        $spec = new StringValueComparingSpecification('s>', 'date', '2021-05-25');
        $this->assertEquals($spec->getType(), 's>');
        $spec = new StringValueComparingSpecification('s!>', 'date', '2021-05-25');
        $this->assertEquals($spec->getType(), 's!>');
        $spec = new StringValueComparingSpecification('s<=', 'date', '2021-05-25');
        $this->assertEquals($spec->getType(), 's<=');
        $spec = new StringValueComparingSpecification('s>=', 'date', '2021-05-25');
        $this->assertEquals($spec->getType(), 's>=');
        $spec = new StringValueComparingSpecification('like', 'date', '2021-05-25');
        $this->assertEquals($spec->getType(), 'like');
        $spec = new StringValueComparingSpecification('!like', 'date', '2021-05-25');
        $this->assertEquals($spec->getType(), '!like');
    }

    public function testIsUnary(): void
    {
        $spec = new StringValueComparingSpecification('s=', 'date', '2021-05-25');
        $this->assertEquals($spec->isUnary(), false);
    }

    public function testIsValueComparing(): void
    {
        $spec = new StringValueComparingSpecification('s=', 'date', '2021-05-25');
        $this->assertEquals($spec->isValueComparing(), true);
    }

    public function testIsFieldsComparing(): void
    {
        $spec = new StringValueComparingSpecification('s=', 'date', '2021-05-25');
        $this->assertEquals($spec->isFieldsComparing(), false);
    }

    public function testIsArrayComparing(): void
    {
        $spec = new StringValueComparingSpecification('s=', 'date', '2021-05-25');
        $this->assertEquals($spec->isArrayComparing(), false);
    }

    public function testNumericComparing(): void
    {
        $spec = new StringValueComparingSpecification('s=', 'date', '2021-05-25');
        $this->assertEquals($spec->isNumericComparing(), false);
    }

    public function testStringComparing(): void
    {
        $spec = new StringValueComparingSpecification('s=', 'date', '2021-05-25');
        $this->assertEquals($spec->isStringComparing(), true);
    }
}