<?php

namespace Mnemesong\SpexUnitTest\specified\traits;

use Mnemesong\Spex\Sp;
use Mnemesong\Spex\specified\SpecifiedInterface;
use PHPUnit\Framework\TestCase;

trait SpecifiedTestTrait
{
    abstract protected function getInitializedSpecified(): SpecifiedInterface;
    
    abstract protected function useTestCase(): TestCase;

    public function testBasics(): void
    {
        $specified = $this->getInitializedSpecified();
        $this->useTestCase()->assertNull($specified->getSpecification());
        $newSpecified = $specified->where(Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']));
        $this->useTestCase()->assertEquals(Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']), $newSpecified->getSpecification());
        $this->useTestCase()->assertNull($specified->getSpecification());
    }

    public function testAndWhere(): void
    {
        $specified = $this->getInitializedSpecified();
        $newSpecified = $specified->andWhere(Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']));
        $this->useTestCase()->assertEquals(Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']), $newSpecified->getSpecification());
        $this->useTestCase()->assertNull($specified->getSpecification());

        $newSpecified = $newSpecified->andWhere(Sp::ex('s>=', 'date', '2022-01-02'));
        $this->useTestCase()->assertEquals(Sp::ex('and', [
            Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']),
            Sp::ex('s>=', 'date', '2022-01-02')
        ]), $newSpecified->getSpecification());

        $newSpecified = $newSpecified->andWhere(Sp::ex('n=', 'age', 22));
        $this->useTestCase()->assertEquals(Sp::ex('and', [
            Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']),
            Sp::ex('s>=', 'date', '2022-01-02'),
            Sp::ex('n=', 'age', 22)
        ]), $newSpecified->getSpecification());

        $newSpecified = $newSpecified->orWhere(Sp::ex('n=', 'age', 22));
        $this->useTestCase()->assertEquals(Sp::ex('or', [
            Sp::ex('and', [
                Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']),
                Sp::ex('s>=', 'date', '2022-01-02'),
                Sp::ex('n=', 'age', 22)
            ]),
            Sp::ex('n=', 'age', 22)
        ]), $newSpecified->getSpecification());
    }

    public function testOrWhere(): void
    {
        $specified = $this->getInitializedSpecified();
        $newSpecified = $specified->orWhere(Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']));
        $this->useTestCase()->assertEquals(Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']), $newSpecified->getSpecification());
        $this->useTestCase()->assertNull($specified->getSpecification());

        $newSpecified = $newSpecified->orWhere(Sp::ex('s>=', 'date', '2022-01-02'));
        $this->useTestCase()->assertEquals(Sp::ex('or', [
            Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']),
            Sp::ex('s>=', 'date', '2022-01-02')
        ]), $newSpecified->getSpecification());

        $newSpecified = $newSpecified->orWhere(Sp::ex('n=', 'age', 22));
        $this->useTestCase()->assertEquals(Sp::ex('or', [
            Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']),
            Sp::ex('s>=', 'date', '2022-01-02'),
            Sp::ex('n=', 'age', 22)
        ]), $newSpecified->getSpecification());

        $newSpecified = $newSpecified->andWhere(Sp::ex('n=', 'age', 22));
        $this->useTestCase()->assertEquals(Sp::ex('and', [
            Sp::ex('or', [
                Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']),
                Sp::ex('s>=', 'date', '2022-01-02'),
                Sp::ex('n=', 'age', 22)
            ]),
            Sp::ex('n=', 'age', 22)
        ]), $newSpecified->getSpecification());
    }
}