<?php
declare(strict_types=1);

namespace Mnemesong\Spex\specifications\comparing;

use Mnemesong\Spex\specifications\abstracts\AbstractValueComparingSpecification;
use Webmozart\Assert\Assert;

/**
 * ENG: Specification describing a character-by-character comparison of a field with a string value.
 * This object reflects type specifications:
 * - "s=" - Checks if the field value is equal to the string.
 * - "s!=" - Checks if a field value is not equal to a string (not null-safe: if one of the values ​​is NULL,
 *           the other is not, the verification will still fail).
 * - "s<", "s>", "s<=", "s>=" - Comparison of field value with string (not null-safe). The comparison is done character
 *           by character.
 * - "clike" - Checks for partial occurrence of a string in the field value as a substring
 *
 * RUS: Спецификация описывающая посимвольное сравнение поля со строковым значением.
 * Данный объект отражает спецификации типа:
 * - "s=" - Проверяет равенство значения поля со строкой.
 * - "s!=" - Проверяет неравенство значения поля со строкой (не ноль-безопасное: если одно из значений NULL, Другое нет,
 *           все равно проверка будет не пройдена).
 * - "s<", "s>", "s<=", "s>=" - Сравнение значения поля со строкой (не ноль-безопасное). Сравнение происходит посимвольно.
 * - "clike" - Проверяет частичное вхождение строки в значеие поля в виде подстроки
 *
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class StringValueComparingSpecification extends AbstractValueComparingSpecification
{
    protected string $value;

    /**
     * @param string $type
     * @param string $field
     * @param string $value
     */
    public function __construct(string $type, string $field, string $value)
    {
        Assert::inArray($type, static::getAvailableTypes(), 'Incorrect type of specification');
        $this->type = $type;
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string[]
     */
    static function getAvailableTypes(): array
    {
        return [
            self::TYPE_STR_EQUALS,
            self::TYPE_STR_NOT_EQUALS_NULL_UNSAFE,
            self::TYPE_STR_LESS_THAN,
            self::TYPE_STR_NOT_LESS_THAN,
            self::TYPE_STR_MORE_THAN,
            self::TYPE_STR_NOT_MORE_THAN,
            self::TYPE_STR_LIKE,
            self::TYPE_STR_NOT_EQUALS_NULL_SAFE
        ];
    }

    /**
     * @return bool
     */
    public function isNumericComparing(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isStringComparing(): bool
    {
        return true;
    }
}