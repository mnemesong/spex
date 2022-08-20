<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\specifications\comparing;

use Mnemesong\Spex\specifications\abstracts\SpecificationTrait;
use Mnemesong\Spex\specifications\comparing\ArrayComparingSpecification;
use Mnemesong\Spex\specifications\comparing\UnaryValueSpecification;
use Mnemesong\SpexUnitTest\specifications\abstracts\SpecificationTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class UnarySpecificationTest extends TestCase
{
    use SpecificationTestTrait;

    /**
     * @return void
     */
    public function testBasics(): void
    {
        $spec = new UnaryValueSpecification('!empty', 'url');
        $this->assertEquals($spec->getType(), '!empty');
        $this->assertEquals($spec->getField(), 'url');
    }

    /**
     * @return void
     */
    public function testConstructionException1(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new UnaryValueSpecification('!', 'url');
    }

    /**
     * @return void
     */
    public function testConstructionException2(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new UnaryValueSpecification('!=', 'url');
    }

    /**
     * @return void
     */
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

    /**
     * @return void
     */
    public function testAssertClass(): void
    {
        $spec = new UnaryValueSpecification('empty', 'comment');
        $spec = UnaryValueSpecification::assertClass($spec);
        $this->assertTrue(is_a($spec, UnaryValueSpecification::class));
    }

    /**
     * @return void
     */
    public function testAssertClassException(): void
    {
        $spec = new ArrayComparingSpecification('in', 'name', ['Mary']);
        $this->expectException(\InvalidArgumentException::class);
        $spec = UnaryValueSpecification::assertClass($spec);
    }
}