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
    public function testBasics(): void
    {
        $spec = new UnaryValueSpecification('!empty', 'url');
        $this->assertEquals($spec->getType(), '!empty');
        $this->assertEquals($spec->getField(), 'url');
    }

    public function testConstructionException1(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new UnaryValueSpecification('!', 'url');
    }

    public function testConstructionException2(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new UnaryValueSpecification('!=', 'url');
    }

    public function testIsComposite(): void
    {
        $spec = new UnaryValueSpecification('empty', 'url');
        $this->assertEquals($spec->isComposite(), false);
    }

    public function testGetType(): void
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

    public function testIsUnary(): void
    {
        $spec = new UnaryValueSpecification('empty', 'url');
        $this->assertEquals($spec->isUnary(), true);
    }

    public function testIsValueComparing(): void
    {
        $spec = new UnaryValueSpecification('empty', 'url');
        $this->assertEquals($spec->isValueComparing(), false);
    }

    public function testIsFieldsComparing(): void
    {
        $spec = new UnaryValueSpecification('empty', 'url');
        $this->assertEquals($spec->isFieldsComparing(), false);
    }

    public function testIsArrayComparing(): void
    {
        $spec = new UnaryValueSpecification('empty', 'url');
        $this->assertEquals($spec->isArrayComparing(), false);
    }
}