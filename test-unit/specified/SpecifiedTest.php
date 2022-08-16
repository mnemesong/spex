<?php

namespace Mnemesong\SpexUnitTest\specified;

use Mnemesong\Spex\Sp;
use Mnemesong\SpexStubs\specified\SpecifiedStub;
use PHPUnit\Framework\TestCase;

class SpecifiedTest extends TestCase
{
    public function testBasics()
    {
        $specified = new SpecifiedStub();
        $this->assertNull($specified->getSpecification());
        $newSpecified = $specified->where(Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']));
        $this->assertEquals(Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']), $newSpecified->getSpecification());
        $this->assertNull($specified->getSpecification());
    }

    public function testAndWhere()
    {
        $specified = new SpecifiedStub();
        $newSpecified = $specified->andWhere(Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']));
        $this->assertEquals(Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']), $newSpecified->getSpecification());
        $this->assertNull($specified->getSpecification());

        $newSpecified = $newSpecified->andWhere(Sp::ex('s>=', 'date', '2022-01-02'));
        $this->assertEquals(Sp::ex('and', [
            Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']),
            Sp::ex('s>=', 'date', '2022-01-02')
        ]), $newSpecified->getSpecification());

        $newSpecified = $newSpecified->andWhere(Sp::ex('n=', 'age', 22));
        $this->assertEquals(Sp::ex('and', [
            Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']),
            Sp::ex('s>=', 'date', '2022-01-02'),
            Sp::ex('n=', 'age', 22)
        ]), $newSpecified->getSpecification());

        $newSpecified = $newSpecified->orWhere(Sp::ex('n=', 'age', 22));
        $this->assertEquals(Sp::ex('or', [
            Sp::ex('and', [
                Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']),
                Sp::ex('s>=', 'date', '2022-01-02'),
                Sp::ex('n=', 'age', 22)
            ]),
            Sp::ex('n=', 'age', 22)
        ]), $newSpecified->getSpecification());
    }

    public function testOrWhere()
    {
        $specified = new SpecifiedStub();
        $newSpecified = $specified->orWhere(Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']));
        $this->assertEquals(Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']), $newSpecified->getSpecification());
        $this->assertNull($specified->getSpecification());

        $newSpecified = $newSpecified->orWhere(Sp::ex('s>=', 'date', '2022-01-02'));
        $this->assertEquals(Sp::ex('or', [
            Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']),
            Sp::ex('s>=', 'date', '2022-01-02')
        ]), $newSpecified->getSpecification());

        $newSpecified = $newSpecified->orWhere(Sp::ex('n=', 'age', 22));
        $this->assertEquals(Sp::ex('or', [
            Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']),
            Sp::ex('s>=', 'date', '2022-01-02'),
            Sp::ex('n=', 'age', 22)
        ]), $newSpecified->getSpecification());

        $newSpecified = $newSpecified->andWhere(Sp::ex('n=', 'age', 22));
        $this->assertEquals(Sp::ex('and', [
            Sp::ex('or', [
                Sp::ex('in', 'name', ['Jones', 'Valeria', 'Sam']),
                Sp::ex('s>=', 'date', '2022-01-02'),
                Sp::ex('n=', 'age', 22)
            ]),
            Sp::ex('n=', 'age', 22)
        ]), $newSpecified->getSpecification());
    }

}