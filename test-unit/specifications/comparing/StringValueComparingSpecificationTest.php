<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\specifications\comparing;

use Mnemesong\Spex\specifications\abstracts\SpecificationTrait;
use Mnemesong\Spex\specifications\comparing\ArrayComparingSpecification;
use Mnemesong\Spex\specifications\comparing\StringValueComparingSpecification;
use Mnemesong\SpexUnitTest\specifications\abstracts\SpecificationTestTrait;
use PHPUnit\Framework\TestCase;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class StringValueComparingSpecificationTest extends TestCase
{
    use SpecificationTestTrait;

    /**
     * @return void
     */
    public function testBasics(): void
    {
        $spec = new StringValueComparingSpecification('s<', 'date', '2021-05-25');
        $this->assertEquals($spec->getType(), 's<');
        $this->assertEquals($spec->getField(), 'date');
        $this->assertEquals($spec->getValue(), '2021-05-25');
    }

    /**
     * @return void
     */
    public function testConstructException1(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new StringValueComparingSpecification('in', 'date', '2021-05-25');
    }

    /**
     * @return void
     */
    public function testConstructException2(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $spec = new StringValueComparingSpecification('or', 'date', '2021-05-25');
    }

    /**
     * @return void
     */
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

    /**
     * @return void
     */
    public function testAssertClass(): void
    {
        $spec = new StringValueComparingSpecification('s=', 'name', 'Mary');
        $spec = StringValueComparingSpecification::assertClass($spec);
        $this->assertTrue(is_a($spec, StringValueComparingSpecification::class));
    }

    /**
     * @return void
     */
    public function testAssertClassException(): void
    {
        $spec = new ArrayComparingSpecification('in', 'name', ['Mary']);
        $this->expectException(\InvalidArgumentException::class);
        $spec = StringValueComparingSpecification::assertClass($spec);
    }
}