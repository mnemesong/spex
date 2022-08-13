<?php
declare(strict_types=1);

namespace Mnemesong\Spex\specifications\comparing;

use Mnemesong\Spex\specifications\abstracts\AbstractNonCompositeSpecification;
use Webmozart\Assert\Assert;

/**
 * ENG: Specification describing the comparison of a field with another field. This object reflects type specifications:
 * - "c=" - Checks if two fields are equal
 * - "c!=" - Checks if the values of two fields are not equal (not null-safe: if one of the values is NULL, the other is not,
 * check will still fail)
 * - "c<", "c>", "c<=", "c>=" - Compare values of two table fields (non-null-safe)
 *
 * RUS: Спецификация описывающая сравнение поля с другим полем. Данный объект отражает спецификации типа:
 * - "c=" - Проверяет равенство значений двух полей
 * - "c!=" - Проверяет неравенство значений двух полей (не ноль-безопасное: если одно из значений NULL, Другое нет,
 *           все равно проверка будет не пройдена)
 * - "c<", "c>", "c<=", "c>=" - Сравнение значений двух полей таблицы (не ноль-безопасное)
 * - "clike" - Проверяет частичное вхождение второго поля в первое в виде подстроки
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
     * @return array
     */
    static function getAvailableTypes(): array
    {
        return [
            self::TYPE_COLUMN_EQUALS,
            self::TYPE_COLUMN_NOT_EQUALS,
            self::TYPE_COLUMN_EQUALS_NULL_SAFE,
            self::TYPE_COLUMN_NOT_EQUALS_NULL_SAFE,
            self::TYPE_COLUMN_MORE_THAN,
            self::TYPE_COLUMN_NOT_MORE_THAN,
            self::TYPE_COLUMN_LESS_THAN,
            self::TYPE_COLUMN_NOT_LESS_THAN,
            self::TYPE_COLUMN_LIKE,
        ];
    }
}