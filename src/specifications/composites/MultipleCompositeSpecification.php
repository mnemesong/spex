<?php
declare(strict_types=1);

namespace Mnemesong\Spex\specifications\composites;

use Mnemesong\Spex\specifications\abstracts\SpecificationTrait;
use Mnemesong\Spex\specifications\SpecificationInterface;
use Webmozart\Assert\Assert;

/**
 * RUS: Абстрактный класс содержит спецификации поведения "и" и "или".
 * Спецификации «И» и «Или» являются составными спецификациями, содержащими 2 или более дочерних
 * Реализованы объекты SpecificationInterface.
 *
 * ENG: Abstract class contains "and" and "or" specifications behaviour.
 * "And" and "Or" specifications is composite specifications, thats contains 2 or more child
 * SpecificationInterface implemented objects. Using in storage search running.
 *
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
class MultipleCompositeSpecification implements SpecificationInterface
{
    use SpecificationTrait;

    /**
     * @var SpecificationInterface[] $specs
     */
    protected array $specs;

    /**
     * @param SpecificationInterface[] $specs
     */
    public function __construct(string $type, array $specs)
    {
        Assert::inArray($type, static::availableTypes(), "Incorrect type of operation. "
            . "expect one of: " . implode(", ", static::availableTypes()));
        Assert::minCount($specs, 2, '"And" and "Or" specification should contains 2 or more child '
            . 'specifications');
        /* @phpstan-ignore-next-line */
        Assert::allSubclassOf($specs, SpecificationInterface::class,
            'Every object should be class implemented SpecificationInterface');
        $this->type = $type;
        $this->specs = $specs;
    }

    /**
     * @return SpecificationInterface[]
     */
    public function getSpecifications(): array
    {
        return $this->specs;
    }

    /**
     * @param SpecificationInterface $spec
     * @return $this
     */
    public function withNewOne(SpecificationInterface $spec): self
    {
        $clone = clone $this;
        $clone->specs[] = $spec;
        return $clone;
    }

    /**
     * @param SpecificationInterface[] $specs
     * @return $this
     */
    public function withNewMany(array $specs): self
    {
        Assert::allIsAOf($specs, SpecificationInterface::class, "Except array of specifications");
        $clone = clone $this;
        $clone->specs = array_merge($this->specs, $specs);
        return $clone;
    }

    /**
     * @return string[]
     */
    static function availableTypes(): array
    {
        return [
            self::TYPE_AND,
            self::TYPE_OR,
        ];
    }

    /**
     * @param SpecificationInterface $spec
     * @return static
     */
    public static function assertClass(SpecificationInterface $spec): self
    {
        Assert::isAOf($spec, MultipleCompositeSpecification::class);
        /* @var MultipleCompositeSpecification $spec */
        return $spec;
    }
}