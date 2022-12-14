<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\specifications\composites;

use Mnemesong\Spex\specifications\abstracts\SpecificationTrait;
use Mnemesong\Spex\specifications\comparing\ArrayComparingSpecification;
use Mnemesong\Spex\specifications\comparing\NumericValueComparingSpecification;
use Mnemesong\Spex\specifications\comparing\StringValueComparingSpecification;
use Mnemesong\Spex\specifications\comparing\UnaryValueSpecification;
use Mnemesong\Spex\specifications\composites\MultipleCompositeSpecification;
use Mnemesong\SpexUnitTest\specifications\abstracts\SpecificationTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class MultipleCompositeSpecificationTest extends TestCase
{
    use SpecificationTestTrait;

    /**
     * @return void
     */
    public function testBasics(): void
    {
        $spec = new MultipleCompositeSpecification('and', [
            new NumericValueComparingSpecification('n>', 'age', 18),
            new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola'])
        ]);
        $this->assertEquals($spec->getType(), 'and');
        $this->assertEquals($spec->getSpecifications(), [
            new NumericValueComparingSpecification('n>', 'age', 18),
            new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola'])
        ]);
    }

    /**
     * @return void
     */
    public function testConstructExceptions1(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new MultipleCompositeSpecification('=', [
            new NumericValueComparingSpecification('n>', 'age', 18),
            new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola'])
        ]);
    }

    /**
     * @return void
     */
    public function testConstructExceptions2(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new MultipleCompositeSpecification('in', [
            new NumericValueComparingSpecification('n>', 'age', 18),
            new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola'])
        ]);
    }

    /**
     * @return void
     */
    public function testConstructExceptions3(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new MultipleCompositeSpecification('and', [
            new NumericValueComparingSpecification('n>', 'age', 18),
        ]);
    }

    /**
     * @return void
     */
    public function testWithNewOne(): void
    {
        $spec = new MultipleCompositeSpecification('and', [
            new NumericValueComparingSpecification('n>', 'age', 18),
            new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola'])
        ]);
        $newSpec = $spec->withNewOne(new NumericValueComparingSpecification('n=', 'age', 20));

        //Assert new spec adds correctly
        $this->assertEquals([
            new NumericValueComparingSpecification('n>', 'age', 18),
            new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola']),
            new NumericValueComparingSpecification('n=', 'age', 20)
        ], $newSpec->getSpecifications());

        //Assert original spec immutable
        $this->assertEquals([
            new NumericValueComparingSpecification('n>', 'age', 18),
            new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola']),
        ], $spec->getSpecifications());
    }

    /**
     * @return void
     */
    public function testWithNewMany(): void
    {
        $spec = new MultipleCompositeSpecification('and', [
            new NumericValueComparingSpecification('n>', 'age', 18),
            new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola'])
        ]);
        $newSpec = $spec->withNewMany([
            new NumericValueComparingSpecification('n=', 'age', 20),
            new StringValueComparingSpecification('!like', 'data', '2022-05-06'),
        ]);

        //Assert new spec adds correctly
        $this->assertEquals([
            new NumericValueComparingSpecification('n>', 'age', 18),
            new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola']),
            new NumericValueComparingSpecification('n=', 'age', 20),
            new StringValueComparingSpecification('!like', 'data', '2022-05-06'),
        ], $newSpec->getSpecifications());

        //Assert original spec immutable
        $this->assertEquals([
            new NumericValueComparingSpecification('n>', 'age', 18),
            new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola']),
        ], $spec->getSpecifications());
    }

    /**
     * @return void
     */
    public function testGetType(): void
    {
        $spec = new MultipleCompositeSpecification('and', [
            new NumericValueComparingSpecification('n>', 'age', 18),
            new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola'])
        ]);
        $this->assertEquals($spec->getType(), 'and');
        $spec = new MultipleCompositeSpecification('or', [
            new NumericValueComparingSpecification('n>', 'age', 18),
            new ArrayComparingSpecification('in', 'name', ['Sarah', 'Viola'])
        ]);
        $this->assertEquals($spec->getType(), 'or');
    }

    /**
     * @return void
     */
    public function testAssertClass(): void
    {
        $spec = new MultipleCompositeSpecification('and', [
            new UnaryValueSpecification('empty', 'data'),
            new UnaryValueSpecification('!null', 'isRegistered')
        ]);
        $spec = MultipleCompositeSpecification::assertClass($spec);
        $this->assertTrue(is_a($spec, MultipleCompositeSpecification::class));
    }

    /**
     * @return void
     */
    public function testAssertClassException(): void
    {
        $spec = new UnaryValueSpecification('empty', 'data');
        $this->expectException(\InvalidArgumentException::class);
        $spec = MultipleCompositeSpecification::assertClass($spec);
    }
}