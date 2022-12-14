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
final class ArrayComparingSpecification implements SpecificationInterface
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
    public static function availableTypes(): array
    {
        return [
            self::TYPE_IN,
            self::TYPE_NOT_IN
        ];
    }

    /**
     * @param SpecificationInterface $spec
     * @return static
     */
    public static function assertClass(SpecificationInterface $spec): self
    {
        Assert::isAOf($spec, ArrayComparingSpecification::class);
        /* @var ArrayComparingSpecification $spec */
        return $spec;
    }
}