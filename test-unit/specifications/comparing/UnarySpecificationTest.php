<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\specifications\comparing;

use Mnemesong\Spex\specifications\comparing\UnaryValueSpecification;
use Mnemesong\SpexUnitTest\specifications\abstracts\AbstractSpecificationTestTemplate;
use Mnemesong\SpexUnitTest\specifications\abstracts\NonCompositeSpecificationTestTemplate;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class UnarySpecificationTest extends AbstractSpecificationTestTemplate
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

}