<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\specifications\composites;

use Mnemesong\Spex\specifications\abstracts\SpecificationTrait;
use Mnemesong\Spex\specifications\comparing\NumericValueComparingSpecification;
use Mnemesong\Spex\specifications\comparing\UnaryValueSpecification;
use Mnemesong\Spex\specifications\composites\UnaryCompositeSpecification;
use Mnemesong\SpexUnitTest\specifications\abstracts\SpecificationTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class UnaryCompositeSpecificationTest extends TestCase
{
    use SpecificationTestTrait;

    /**
     * @return void
     */
    public function testBasics(): void
    {
        $spec = new UnaryCompositeSpecification(
            '!',
            new NumericValueComparingSpecification('n=', 'age', 25)
        );
        $this->assertEquals($spec->getType(), '!');
        $this->assertEquals($spec->getSpec(), new NumericValueComparingSpecification('n=', 'age', 25));
    }

    /**
     * @return void
     */
    public function testConstructorException1(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new UnaryCompositeSpecification(
            '!=',
            new NumericValueComparingSpecification('n=', 'age', 25)
        );
    }

    /**
     * @return void
     */
    public function testConstructorException2(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new UnaryCompositeSpecification(
            'and',
            new NumericValueComparingSpecification('n=', 'age', 25)
        );
    }

    /**
     * @return void
     */
    public function testGetType(): void
    {
        $spec = new UnaryCompositeSpecification(
            '!',
            new NumericValueComparingSpecification('n=', 'age', 25)
        );
        $this->assertEquals($spec->getType(), '!');
    }

    /**
     * @return void
     */
    public function testAssertClass(): void
    {
        $spec = new UnaryCompositeSpecification('!', new UnaryValueSpecification('null', 'date'));
        $spec = UnaryCompositeSpecification::assertClass($spec);
        $this->assertTrue(is_a($spec, UnaryCompositeSpecification::class));
    }

    /**
     * @return void
     */
    public function testAssertClassException(): void
    {
        $spec = new UnaryValueSpecification('null', 'date');
        $this->expectException(\InvalidArgumentException::class);
        $spec = UnaryCompositeSpecification::assertClass($spec);
    }
}