<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\specifications\comparing;

use Mnemesong\Spex\specifications\abstracts\SpecificationTrait;
use Mnemesong\Spex\specifications\comparing\StringValueComparingSpecification;
use PHPUnit\Framework\TestCase;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class StringValueComparingSpecificationTest extends TestCase
{
    use SpecificationTrait;

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

}