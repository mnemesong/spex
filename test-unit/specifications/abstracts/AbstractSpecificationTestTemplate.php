<?php
declare(strict_types=1);

namespace Mnemesong\SpexUnitTest\specifications\abstracts;

use PHPUnit\Framework\TestCase;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
abstract class AbstractSpecificationTestTemplate extends TestCase
{
    abstract public function testGetType(): void;
}