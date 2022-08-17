<?php

namespace Mnemesong\SpexUnitTest\specified;

use Mnemesong\Spex\specified\SpecifiedInterface;
use Mnemesong\SpexStubs\specified\SpecifiedStub;
use Mnemesong\SpexUnitTest\specified\traits\SpecifiedTestTrait;
use PHPUnit\Framework\TestCase;

class SpecifiedTest extends TestCase
{
    use SpecifiedTestTrait;

    protected function getInitializedSpecified(): SpecifiedInterface
    {
        return new SpecifiedStub();
    }

    protected function useTestCase(): TestCase
    {
        return $this;
    }
}