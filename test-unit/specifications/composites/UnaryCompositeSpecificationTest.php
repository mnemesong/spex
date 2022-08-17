<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\specifications\composites;

use Mnemesong\Spex\specifications\comparing\NumericValueComparingSpecification;
use Mnemesong\Spex\specifications\composites\UnaryCompositeSpecification;
use Mnemesong\SpexUnitTest\specifications\abstracts\CompositeSpecificationTestTemplate;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class UnaryCompositeSpecificationTest extends CompositeSpecificationTestTemplate
{
    public function testBasics(): void
    {
        $spec = new UnaryCompositeSpecification(
            '!',
            new NumericValueComparingSpecification('n=', 'age', 25)
        );
        $this->assertEquals($spec->getType(), '!');
        $this->assertEquals($spec->getSpec(), new NumericValueComparingSpecification('n=', 'age', 25));
    }

    public function testConstructorException1(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new UnaryCompositeSpecification(
            '!=',
            new NumericValueComparingSpecification('n=', 'age', 25)
        );
    }

    public function testConstructorException2(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new UnaryCompositeSpecification(
            'and',
            new NumericValueComparingSpecification('n=', 'age', 25)
        );
    }

    public function testIsComposite(): void
    {
        $spec = new UnaryCompositeSpecification(
            '!',
            new NumericValueComparingSpecification('n=', 'age', 25)
        );
        $this->assertEquals($spec->isComposite(), true);
    }

    public function testGetType(): void
    {
        $spec = new UnaryCompositeSpecification(
            '!',
            new NumericValueComparingSpecification('n=', 'age', 25)
        );
        $this->assertEquals($spec->getType(), '!');
    }

    public function testCount(): void
    {
        $spec = new UnaryCompositeSpecification(
            '!',
            new NumericValueComparingSpecification('n=', 'age', 25)
        );
        $this->assertEquals($spec->count(), 1);
    }

    public function testIsMultiple(): void
    {
        $spec = new UnaryCompositeSpecification(
            '!',
            new NumericValueComparingSpecification('n=', 'age', 25)
        );
        $this->assertEquals($spec->isMultiple(), false);
    }

    public function testIsUnary(): void
    {
        $spec = new UnaryCompositeSpecification(
            '!',
            new NumericValueComparingSpecification('n=', 'age', 25)
        );
        $this->assertEquals($spec->isUnary(), true);
    }
}