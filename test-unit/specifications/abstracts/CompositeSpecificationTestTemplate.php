<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\specifications\abstracts;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
abstract class CompositeSpecificationTestTemplate extends AbstractSpecificationTestTemplate
{
    abstract public function testCount(): void;

    abstract public function testIsMultiple(): void;

    abstract public function testIsUnary(): void;
}