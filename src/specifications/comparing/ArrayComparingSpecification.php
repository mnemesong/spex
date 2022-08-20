<?php
declare(strict_types=1);

namespace Mnemesong\Spex\specifications\comparing;

use Mnemesong\Spex\specifications\abstracts\SpecificationTrait;
use Mnemesong\Spex\specifications\SpecificationInterface;
use Webmozart\Assert\Assert;

/**
 * ENG: Specification describing the comparison of a field with an array. This object reflects type specifications:
 * - "in" - checks if the field value matches one of the values from the array
 * - "in" - checks if the field value matches no one of the values from the array
 *
 * RUS: Спецификация описывающая сравнение поля с массивом. Данный объект отражает спецификации типа:
 * - "in" - проверяет соответствие зачения поля одному из значений из массива
 * - "in" - проверяет несоответствие зачения поля любому из значений из массива
 *
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class ArrayComparingSpecification implements SpecificationInterface
{
    use SpecificationTrait;

    protected string $field;
    /* @var string[] $value */
    /* @phpstan-ignore-next-line */
    protected array $value;

    /**
     * @param string $type
     * @param string $field
     * @param string[] $value
     */
    public function __construct(string $type, string $field, array $value)
    {
        Assert::inArray($type, static::availableTypes(), 'Incorrect type of specification');
        $this->field = $field;
        $this->value = array_map(fn($item) => (strval($item)), $value);
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
        return false;
    }

    /**
     * @return bool
     */
    public function isArrayComparing(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function getValue(): array
    {
        return $this->value;
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
            self::TYPE_IN,
            self::TYPE_NOT_IN
        ];
    }
}