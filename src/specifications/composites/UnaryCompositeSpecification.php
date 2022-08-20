<?php
declare(strict_types=1);

namespace Mnemesong\Spex\specifications\composites;

use Mnemesong\Spex\specifications\abstracts\SpecificationTrait;
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
class UnaryCompositeSpecification implements SpecificationInterface
{
    use SpecificationTrait;

    protected SpecificationInterface $spec;

    /**
     * @param string $type
     * @param SpecificationInterface $spec
     */
    public function __construct(string $type, SpecificationInterface $spec)
    {
        Assert::inArray($type, static::availableTypes(), "except one of available types: "
            . implode(", ", static::availableTypes()) . ", get value: " . $type);
        $this->type = $type;
        $this->spec = $spec;
    }

    /**
     * @return SpecificationInterface
     */
    public function getSpec(): SpecificationInterface
    {
        return $this->spec;
    }

    /**
     * @return string[]
     */
    static function availableTypes(): array
    {
        return [
            self::TYPE_NOT,
        ];
    }

    /**
     * @param SpecificationInterface $spec
     * @return static
     */
    public static function assertClass(SpecificationInterface $spec): self
    {
        Assert::isAOf($spec, UnaryCompositeSpecification::class);
        /* @var UnaryCompositeSpecification $spec */
        return $spec;
    }
}