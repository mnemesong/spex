<?php
declare(strict_types=1);

namespace Mnemesong\Spex\specifications\comparing;

use Mnemesong\Spex\specifications\abstracts\AbstractValueComparingSpecification;
use Webmozart\Assert\Assert;

/**
 * ENG: Specification describing the comparison of a field with a number. This object reflects type specifications:
 * - "n=" - Checks if the field values are equal to the number.
 * - "n!=" - Checks if the field values are not equal to a number (not null-safe: if one of the values is NULL,
 * the other is not, check will still fail)
 * - "n<", "n>", "n<=", "n>=" - Compare field value with number (non-null-safe)
 *
 * RUS: Спецификация описывающая сравнение поля с числом. Данный объект отражает спецификации типа:
 * - "n=" - Проверяет равенство значений поля с числом.
 * - "n!=" - Проверяет неравенство значений поля с числом (не ноль-безопасное: если одно из значений NULL, Другое нет,
 *           все равно проверка будет не пройдена)
 * - "n<", "n>", "n<=", "n>=" - Сравнение значения поля с числом (не ноль-безопасное)
 *
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class NumericValueComparingSpecification extends AbstractValueComparingSpecification
{
    /**
     * @param string $type
     * @param string $field
     * @param mixed $value
     */
    public function __construct(string $type, string $field, $value)
    {
        Assert::inArray($type, static::getAvailableTypes(), 'Incorrect type of specification');
        Assert::numeric($value, 'Value should be numeric');
        $this->type = $type;
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @return array
     */
    static function getAvailableTypes(): array
    {
        return [
            self::TYPE_NUM_EQUALS,
            self::TYPE_NUM_NOT_EQUALS,
            self::TYPE_NUM_NOT_EQUALS_NULL_SAFE,
            self::TYPE_NUM_LESS_THAN,
            self::TYPE_NUM_NOT_LESS_THAN,
            self::TYPE_NUM_MORE_THAN,
            self::TYPE_NUM_NOT_MORE_THAN
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