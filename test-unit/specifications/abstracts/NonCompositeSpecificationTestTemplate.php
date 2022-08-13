<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\specifications\abstracts;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
abstract class NonCompositeSpecificationTestTemplate extends AbstractSpecificationTestTemplate
{
    abstract public function testIsUnary();

    abstract public function testIsValueComparing();

    abstract public function testIsFieldsComparing();

    abstract public function testIsArrayComparing();
}