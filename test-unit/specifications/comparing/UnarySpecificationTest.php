<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\specifications\comparing;

use Mnemesong\Spex\specifications\comparing\UnaryValueSpecification;
use Mnemesong\SpexUnitTest\specifications\abstracts\NonCompositeSpecificationTestTemplate;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class UnarySpecificationTest extends NonCompositeSpecificationTestTemplate
{
    public function testBasics()
    {
        $spec = new UnaryValueSpecification('!empty', 'url');
        $this->assertEquals($spec->getType(), '!empty');
        $this->assertEquals($spec->getField(), 'url');
    }

    public function testConstructionException1()
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new UnaryValueSpecification('!', 'url');
    }

    public function testConstructionException2()
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new UnaryValueSpecification('!=', 'url');
    }

    public function testIsComposite()
    {
        $spec = new UnaryValueSpecification('empty', 'url');
        $this->assertEquals($spec->isComposite(), false);
    }

    public function testGetType()
    {
        $spec = new UnaryValueSpecification('empty', 'url');
        $this->assertEquals($spec->getType(), 'empty');
        $spec = new UnaryValueSpecification('!empty', 'url');
        $this->assertEquals($spec->getType(), '!empty');
        $spec = new UnaryValueSpecification('null', 'url');
        $this->assertEquals($spec->getType(), 'null');
        $spec = new UnaryValueSpecification('!null', 'url');
        $this->assertEquals($spec->getType(), '!null');
    }

    public function testIsUnary()
    {
        $spec = new UnaryValueSpecification('empty', 'url');
        $this->assertEquals($spec->isUnary(), true);
    }

    public function testIsValueComparing()
    {
        $spec = new UnaryValueSpecification('empty', 'url');
        $this->assertEquals($spec->isValueComparing(), false);
    }

    public function testIsFieldsComparing()
    {
        $spec = new UnaryValueSpecification('empty', 'url');
        $this->assertEquals($spec->isFieldsComparing(), false);
    }

    public function testIsArrayComparing()
    {
        $spec = new UnaryValueSpecification('empty', 'url');
        $this->assertEquals($spec->isArrayComparing(), false);
    }
}