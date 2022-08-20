<?php

namespace Mnemesong\SpexUnitTest\specifications\abstracts;

trait SpecificationTestTrait
{
    abstract public function testGetType(): void;

    abstract public function testAssertClass(): void;

    abstract public function testAssertClassException(): void;
}