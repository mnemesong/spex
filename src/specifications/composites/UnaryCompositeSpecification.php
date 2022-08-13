<?php
declare(strict_types=1);

namespace Mnemesong\Spex\specifications\composites;

use Mnemesong\Spex\specifications\abstracts\AbstractCompositeSpecification;
use Mnemesong\Spex\specifications\SpecificationInterface;
use Webmozart\Assert\Assert;

/**
 * ENG: An object reflecting specifications for unary compound comparison operations. Not the current moment reflects the only
 * operation: non-zero-safe negation ("!").
 *
 * RUS: Объект отражающий спецификации для унарных составных операций сравнения. Не текущий момент отражает единственную
 * операцию: не ноль-безопасное отрицание ("!").
 *
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class UnaryCompositeSpecification extends AbstractCompositeSpecification
{
    protected SpecificationInterface $spec;
    protected string $type;

    /**
     * @param string $type
     * @param SpecificationInterface $spec
     */
    public function __construct(string $type, SpecificationInterface $spec)
    {
        Assert::inArray($type, static::getAvailableTypes(), "except one of available types: "
            . implode(", ", static::getAvailableTypes()) . ", get value: " . $type);
        $this->type = $type;
        $this->spec = $spec;
    }

    /**
     * Count of child specifications array
     *
     * @return int
     */
    public function count(): int
    {
        return 1;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return SpecificationInterface
     */
    public function getSpec(): SpecificationInterface
    {
        return $this->spec;
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
    public function isMultiple(): bool
    {
        return false;
    }

    /**
     * @return string[]
     */
    static function getAvailableTypes(): array
    {
        return [
            self::TYPE_NOT,
        ];
    }
}