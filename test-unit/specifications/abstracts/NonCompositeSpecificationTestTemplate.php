<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\specifications\abstracts;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
abstract class NonCompositeSpecificationTestTemplate extends AbstractSpecificationTestTemplate
{
    abstract public function testIsUnary(): void;

    abstract public function testIsValueComparing(): void;

    abstract public function testIsFieldsComparing(): void;

    abstract public function testIsArrayComparing(): void;
}