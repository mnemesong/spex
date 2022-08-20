<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\specifications\comparing;

use Mnemesong\Spex\specifications\abstracts\SpecificationTrait;
use Mnemesong\Spex\specifications\comparing\ArrayComparingSpecification;
use PHPUnit\Framework\TestCase;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class ArrayComparingSpecificationTest extends TestCase
{
    use SpecificationTrait;

    public function testBasics(): void
    {
        $spec = new ArrayComparingSpecification('in', 'date', ['2022-12-01, 2022-11-13']);
        $this->assertEquals($spec->getType(), 'in');
        $this->assertEquals($spec->getValue(), ['2022-12-01, 2022-11-13']);
        $this->assertEquals($spec->getField(), 'date');
    }

    public function testConstructorTypeException1(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new ArrayComparingSpecification('c!=', 'date', ['2022-12-01, 2022-11-13']);
    }

    public function testConstructorTypeException2(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new ArrayComparingSpecification('and', 'date', ['2022-12-01, 2022-11-13']);
    }

    public function testConstructorTypeException3(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new ArrayComparingSpecification('=', 'date', ['2022-12-01, 2022-11-13']);
    }

    public function testGetType(): void
    {
        $spec = new ArrayComparingSpecification('in', 'date', ['2022-12-01, 2022-11-13']);
        $this->assertEquals($spec->getType(), 'in');
        $spec = new ArrayComparingSpecification('!in', 'date', ['2022-12-01, 2022-11-13']);
        $this->assertEquals($spec->getType(), '!in');
    }

}