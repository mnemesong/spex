<?php

namespace Mnemesong\SpexUnitTest\checkers;

use Mnemesong\Spex\specifications\comparing\StringValueComparingSpecification;
use Mnemesong\SpexTestHelpers\checkers\StringSpecificationChecker;
use PHPUnit\Framework\TestCase;

class StringSpecificationCheckerTest extends TestCase
{
    /**
     * @param string $type
     * @param string $comparingVal1
     * @param string $fieldVal2
     * @param bool $result
     * @return void
     */
    protected function tryCheck(string $type, bool $result, ?string $fieldVal2, string $comparingVal1): void
    {
        $spec = new StringValueComparingSpecification($type, 'some', $comparingVal1);
        $this->assertEquals($result, StringSpecificationChecker::check($spec, $fieldVal2));
    }

    /**
     * @return void
     */
    public function testEqual(): void
    {
        $this->tryCheck('s=', true, 'aba', 'aba');
        $this->tryCheck('s=', true, 'aba', 'aba');

        $this->tryCheck('s=', false, 'aba', 'lal');
        $this->tryCheck('s=', false, 'lal', 'aba');

        $this->tryCheck('s=', false, 'aba', 'aas');
        $this->tryCheck('s=', false, 'aas', 'aba');

        $this->tryCheck('s=', false, null, 'aba');
    }

    /**
     * @return void
     */
    public function testNotEqual(): void
    {
        $this->tryCheck('s!=', false, 'aba', 'aba');
        $this->tryCheck('s!=', false, 'aba', 'aba');

        $this->tryCheck('s!=', true, 'aba', 'lal');
        $this->tryCheck('s!=', true, 'lal', 'aba');

        $this->tryCheck('s!=', true, 'aba', 'aas');
        $this->tryCheck('s!=', true, 'aas', 'aba');

        $this->tryCheck('s!=', true, null, 'aba');
    }

    public function testMore(): void
    {
        $this->tryCheck('s>', false, 'aba', 'aba');
        $this->tryCheck('s>', false, 'aba', 'aba');

        $this->tryCheck('s>', false, 'aba', 'lal');
        $this->tryCheck('s>', true, 'lal', 'aba');

        $this->tryCheck('s>', true, 'aba', 'aas');
        $this->tryCheck('s>', false, 'aas', 'aba');

        $this->tryCheck('s>', false, null, 'aba');
    }

    public function testMoreOrEqual(): void
    {
        $this->tryCheck('s>=', true, 'aba', 'aba');
        $this->tryCheck('s>=', true, 'aba', 'aba');

        $this->tryCheck('s>=', false, 'aba', 'lal');
        $this->tryCheck('s>=', true, 'lal', 'aba');

        $this->tryCheck('s>=', true, 'aba', 'aas');
        $this->tryCheck('s>=', false, 'aas', 'aba');

        $this->tryCheck('s>=', false, null, 'aba');
    }
}