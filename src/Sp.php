<?php
declare(strict_types=1);

namespace Mnemesong\Spex;

use Mnemesong\Spex\exceptions\InvalidSpecificationTypeException;
use Mnemesong\Spex\specifications\comparing\ArrayComparingSpecification;
use Mnemesong\Spex\specifications\comparing\ColumnsComparingSpecification;
use Mnemesong\Spex\specifications\comparing\NumericValueComparingSpecification;
use Mnemesong\Spex\specifications\comparing\StringValueComparingSpecification;
use Mnemesong\Spex\specifications\comparing\UnaryValueSpecification;
use Mnemesong\Spex\specifications\composites\MultipleCompositeSpecification;
use Mnemesong\Spex\specifications\composites\UnaryCompositeSpecification;
use Mnemesong\Spex\specifications\SpecificationInterface;
use Webmozart\Assert\Assert;


/**
 * ENG: Auxiliary class for fast and convenient expression of specifications.
 * For example, the expression: Sp::ex('c=', 'field1', 'field2') is equivalent to the Mysql specification: WHERE `field1`=`field2`.
 * A complete list of specifications can be found in the interface \specifications\SpecificationInterface
 *
 * RUS: Вспомогательный класс для быстрого и удобного выражения спецификаций.
 * Например выражение: Sp::ex('c=', 'field1', 'field2') эквивалентно Mysql спецификации: WHERE `field1`=`field2`.
 * Полный список спецификаций можно посмотреть в интерфейсе \specifications\SpecificationInterface
 *
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class Sp
{
    /**
     * Express specification
     *
     * @param string $type
     * @param $opt1
     * @param $opt2
     * @return SpecificationInterface
     */
    public static function ex(string $type, $opt1, $opt2 = null): SpecificationInterface
    {
        if (in_array($type, ArrayComparingSpecification::getAvailableTypes())) {
            Assert::string($opt1, 'For "' . $type . '" specification first option parameter'
                . ' should be string');
            Assert::isArray($opt2, 'For "' . $type . '" specification second option parameter'
                . ' should be array');
            return new ArrayComparingSpecification($type, $opt1, $opt2);
        } elseif (in_array($type, ColumnsComparingSpecification::getAvailableTypes())) {
            Assert::string($opt1, 'For "' . $type . '" specification first option parameter'
                . ' should be string');
            Assert::string($opt2, 'For "' . $type . '" specification second option parameter'
                . ' should be string');
            return new ColumnsComparingSpecification($type, $opt1, $opt2);
        } elseif (in_array($type, NumericValueComparingSpecification::getAvailableTypes())) {
            Assert::string($opt1, 'For "' . $type . '" specification first option parameter'
                . ' should be string');
            Assert::numeric($opt2, 'For "' . $type . '" specification second option parameter'
                . ' should be numeric');
            return new NumericValueComparingSpecification($type, $opt1, $opt2);
        } elseif (in_array($type, StringValueComparingSpecification::getAvailableTypes())) {
            Assert::string($opt1, 'For "' . $type . '" specification first option parameter'
                . ' should be string');
            if (is_numeric($opt2)) {
                $opt2 = strval($opt2);
            }
            Assert::string($opt2, 'For "' . $type . '" specification second option parameter'
                . ' should be string');
            return new StringValueComparingSpecification($type, $opt1, $opt2);
        } elseif (in_array($type, UnaryValueSpecification::getAvailableTypes())) {
            Assert::null($opt2, 'For "' . $type . '" specification second option parameter'
                . ' should be null');
            Assert::string($opt1, 'For "' . $type . '" specification first option parameter'
                . ' should be string');
            return new UnaryValueSpecification($type, $opt1);
        } elseif (in_array($type, MultipleCompositeSpecification::getAvailableTypes())) {
            if (is_array($opt1)) {
                Assert::null($opt2, 'For "' . $type . '" specification second option parameter'
                    . ' should be null, if first is array.');
                Assert::allSubclassOf($opt1, SpecificationInterface::class, 'For "' . $type
                    . '" specification first option parameter should be array of SpecificationInterface '
                    . 'implemented objects. Or both parameters should be SpecificationInterface '
                    . 'implemented objects.');
                return new MultipleCompositeSpecification($type, $opt1);
            }
            Assert::subclassOf($opt1, SpecificationInterface::class, 'For "' . $type
                . '" specification first option parameter should be array of SpecificationInterface '
                . 'implemented objects. Or both parameters should be SpecificationInterface '
                . 'implemented objects.');
            Assert::subclassOf($opt2, SpecificationInterface::class, 'For "' . $type
                . '" if first parameter is object implemented SpecificationInterface, second parameter '
                . 'should be implemented SpecificationInterface object too.');
            return new MultipleCompositeSpecification($type, [$opt1, $opt2]);
        } elseif (in_array($type, UnaryCompositeSpecification::getAvailableTypes())) {
            Assert::subclassOf($opt1, SpecificationInterface::class, 'For "' . $type
                . '" specification first option parameter should be SpecificationInterface '
                . 'implemented object.');
            Assert::null($opt2, 'For "' . $type . '" specification second option parameter'
                . ' should be null');
            return new UnaryCompositeSpecification($type, $opt1);
        }
        throw new InvalidSpecificationTypeException();
    }

    /**
     * @param string $type
     * @param $opt1
     * @param $opt2
     * @return SpecificationInterface
     */
    public function express(string $type, $opt1, $opt2 = null): SpecificationInterface
    {
        return self::ex($type, $opt1, $opt2);
    }
}