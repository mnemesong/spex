<?php
declare(strict_types=1);

namespace Mnemesong\Spex\specifications\comparing;

use Mnemesong\Spex\specifications\abstracts\SpecificationTrait;
use Mnemesong\Spex\specifications\abstracts\ValueComparingSpecificationTrait;
use Mnemesong\Spex\specifications\SpecificationInterface;
use Webmozart\Assert\Assert;

/**
 * ENG: Specification describing the comparison of a field with a number. This object reflects type specifications:
 * - "n=" - Checks if the field values are equal to the number.
 * - "n!=" - Checks if field values are not equal to number (null-safe)
 * - "n<", "n!<", "n>", "n!>", "n<=", "n>=" - Compare field value with number (null-safe)
 *
 * RUS: Спецификация описывающая сравнение поля с числом. Данный объект отражает спецификации типа:
 * - "n=" - Проверяет равенство значений поля с числом.
 * - "n!=" - Проверяет неравенство значений поля с числом (null-безопасное)
 * - "n<", "n!<", "n>", "n!>", "n<=", "n>=" - Сравнение значения поля с числом (null-безопасное)
 *
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class NumericValueComparingSpecification implements SpecificationInterface
{
    use SpecificationTrait;
    use ValueComparingSpecificationTrait;

    protected float $value;
    /**
     * @param string $type
     * @param string $field
     * @param float $value
     */
    public function __construct(string $type, string $field, float $value)
    {
        Assert::inArray($type, static::availableTypes(), 'Incorrect type of specification');
        Assert::numeric($value, 'Value should be numeric');
        $this->type = $type;
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @return string[]
     */
    static function availableTypes(): array
    {
        return [
            self::TYPE_NUM_EQUALS,
            self::TYPE_NUM_NOT_EQUALS,
            self::TYPE_NUM_LESS,
            self::TYPE_NUM_NOT_LESS,
            self::TYPE_NUM_EQUALS_OR_MORE,
            self::TYPE_NUM_MORE,
            self::TYPE_NUM_NOT_MORE,
            self::TYPE_NUM_EQUALS_OR_LESS
        ];
    }

    /**
     * @return bool
     */
    public function isNumericComparing(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isStringComparing(): bool
    {
        return false;
    }
}