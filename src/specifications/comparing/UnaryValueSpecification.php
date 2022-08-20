<?php
declare(strict_types=1);

namespace Mnemesong\Spex\specifications\comparing;

use Mnemesong\Spex\specifications\abstracts\SpecificationTrait;
use Mnemesong\Spex\specifications\SpecificationInterface;
use Webmozart\Assert\Assert;

/**
 * RUS: Спецификация описывающая унарную операцию сравнения с одним из специальных значений.
 * Данный объект отражает спецификации типа:
 * - "null" - Проверяет что значение поля NULL
 * - "!null" - Проверяет что значение поля не NULL
 * - "empty" - Проверяет что значение поля NULL или пустая строка
 * - "!empty" - Проверяет что значение поля не NULL или пустая строка
 *
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class UnaryValueSpecification implements SpecificationInterface
{
    use SpecificationTrait;

    protected string $field;

    /**
     * @param string $type
     * @param string $field
     */
    public function __construct(string $type, string $field)
    {
        Assert::inArray($type, static::availableTypes(), 'Incorrect type of specification');
        $this->type = $type;
        $this->field = $field;
    }

    /**
     * @return bool
     */
    public function isUnary(): bool
    {
        return true;
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
        return false;
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
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @return string[]
     */
    static function availableTypes(): array
    {
        return [
            self::TYPE_EMPTY,
            self::TYPE_NOT_EMPTY,
            self::TYPE_NULL,
            self::TYPE_NOT_NULL,
        ];
    }
}