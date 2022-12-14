<?php
declare(strict_types=1);

namespace Mnemesong\Spex\specifications\comparing;

use Mnemesong\Spex\specifications\abstracts\SpecificationTrait;
use Mnemesong\Spex\specifications\abstracts\ValueComparingSpecificationTrait;
use Mnemesong\Spex\specifications\SpecificationInterface;
use Webmozart\Assert\Assert;

/**
 * ENG: Specification describing a character-by-character comparison of a field with a string value.
 * This object reflects type specifications:
 * - "s=" - Checks if the field value is equal to the string.
 * - "s!=" - Checks if the field value is not equal to the string (null-safe).
 * - "s<", "s!<", "s>", "s!>", "s<=", "s>=" - Comparison of the field value with a string (null-safe).
 *   The comparison is done character by character.
 * - "clike" - Checks for partial occurrence of a string in the field value as a substring
 *
 * RUS: Спецификация описывающая посимвольное сравнение поля со строковым значением.
 * Данный объект отражает спецификации типа:
 * - "s=" - Проверяет равенство значения поля со строкой.
 * - "s!=" - Проверяет неравенство значения поля со строкой (null-безопасное).
 * - "s<", "s!<", "s>", "s!>", "s<=", "s>=" - Сравнение значения поля со строкой (null-безопасное).
 *   Сравнение происходит посимвольно.
 * - "clike" - Проверяет частичное вхождение строки в значеие поля в виде подстроки
 *
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class StringValueComparingSpecification implements SpecificationInterface
{
    use SpecificationTrait;
    use ValueComparingSpecificationTrait;

    protected string $value;

    /**
     * @param string $type
     * @param string $field
     * @param string $value
     */
    public function __construct(string $type, string $field, string $value)
    {
        Assert::inArray($type, static::availableTypes(), 'Incorrect type of specification');
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
    static function availableTypes(): array
    {
        return [
            self::TYPE_STR_EQUALS,
            self::TYPE_STR_NOT_EQUALS,
            self::TYPE_STR_LESS,
            self::TYPE_STR_NOT_LESS,
            self::TYPE_STR_EQUALS_OR_MORE,
            self::TYPE_STR_MORE,
            self::TYPE_STR_NOT_MORE,
            self::TYPE_STR_EQUALS_OR_LESS,
            self::TYPE_STR_LIKE,
            self::TYPE_STR_NOT_LIKE,
        ];
    }

    /**
     * @param SpecificationInterface $spec
     * @return StringValueComparingSpecification
     */
    public static function assertClass(SpecificationInterface $spec): self
    {
        Assert::isAOf($spec, StringValueComparingSpecification::class);
        /* @var StringValueComparingSpecification $spec */
        return $spec;
    }
}