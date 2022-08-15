<?php
declare(strict_types=1);

namespace Mnemesong\Spex\specifications\comparing;

use Mnemesong\Spex\specifications\abstracts\AbstractNonCompositeSpecification;
use Webmozart\Assert\Assert;

/**
 * ENG: Specification describing the comparison of a field with another field. This object reflects type specifications:
 * - "cs=" - Checks if the values of two fields are equal as strings (null-safe)
 * - "cs!=" - Checks if the values of two fields are not equal as strings (null-safe)
 * - "cs<", "cs>", "cs!<", "cs!>", "cs<=", "cs>=" - Compare values of two table fields as strings (null-safe)
 * - "clike" - Checks the partial occurrence of the second field in the first as a substring
 * - "c!like" - Checks the not occurrence of the second field in the first as a substring
 * - "cn=" - Checks if the values of two fields are equal as numbers (null-safe)
 * - "cn!=" - Checks if the values of two fields are not equal as numbers (null-safe)
 * - "cn<", "cn>", "cn!<", "cn!>", "cn<=", "cn>=" - Compare values of two table fields as numbers (null-safe)
 *
 * RUS: Спецификация описывающая сравнение поля с другим полем. Данный объект отражает спецификации типа:
 * - "cs=" - Проверяет равенство значений двух полей как строк (null-безопасно)
 * - "cs!=" - Проверяет неравенство значений двух полей как строк (null-безопасно)
 * - "cs<", "cs>", "cs!<", "cs!>", "cs<=", "cs>=" - Сравнение значений двух полей таблицы как строк (null-безопасное)
 * - "clike" - Проверяет частичное вхождение второго поля в первое в виде подстроки
 * - "c!like" - Проверяет отсутствие вхождения второго поля в первое в виде подстроки
 * - "cn=" - Проверяет равенство значений двух полей как чисел (null-безопасно)
 * - "cn!=" - Проверяет неравенство значений двух полей как чисел (null-безопасно)
 * - "cn<", "cn>", "cn!<", "cn!>", "cn<=", "cn>=" - Сравнение значений двух полей таблицы как чисел (null-безопасное)
 *
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class ColumnsComparingSpecification extends AbstractNonCompositeSpecification
{
    protected string $field1;
    protected string $field2;
    protected string $type;

    /**
     * @param string $field1
     * @param string $field2
     * @param string $type
     */
    public function __construct(string $type, string $field1, string $field2)
    {
        Assert::inArray($type, static::getAvailableTypes(), 'Incorrect type of specification');
        $this->field1 = $field1;
        $this->field2 = $field2;
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function isUnary(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isValueComparing(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isFieldsComparing(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isArrayComparing(): bool
    {
        return false;
    }

    /**
     * @return string
     */
    public function getField1(): string
    {
        return $this->field1;
    }

    /**
     * @return string
     */
    public function getField2(): string
    {
        return $this->field2;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string[]
     */
    static function getAvailableTypes(): array
    {
        return [
            self::TYPE_COLUMN_STR_EQUALS,
            self::TYPE_COLUMN_STR_NOT_EQUALS,
            self::TYPE_COLUMN_STR_MORE,
            self::TYPE_COLUMN_STR_NOT_MORE,
            self::TYPE_COLUMN_STR_EQUALS_OR_LESS,
            self::TYPE_COLUMN_STR_LESS,
            self::TYPE_COLUMN_STR_NOT_LESS,
            self::TYPE_COLUMN_STR_EQUALS_OR_MORE,
            self::TYPE_COLUMN_STR_LIKE,
            self::TYPE_COLUMN_STR_NOT_LIKE,
            self::TYPE_COLUMN_NUM_EQUALS,
            self::TYPE_COLUMN_NUM_NOT_EQUALS,
            self::TYPE_COLUMN_NUM_MORE,
            self::TYPE_COLUMN_NUM_NOT_MORE,
            self::TYPE_COLUMN_NUM_EQUALS_OR_LESS,
            self::TYPE_COLUMN_NUM_LESS,
            self::TYPE_COLUMN_NUM_NOT_LESS,
            self::TYPE_COLUMN_NUM_EQUALS_OR_MORE,
        ];
    }
}