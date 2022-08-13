<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\specifications\abstracts;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
abstract class CompositeSpecificationTestTemplate extends AbstractSpecificationTestTemplate
{
    abstract public function testCount();

    abstract public function testIsMultiple();

    abstract public function testIsUnary();
}