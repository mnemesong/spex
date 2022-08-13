<?php
declare(strict_types=1);

namespace Mnemesong\Spex\specifications\abstracts;

use Mnemesong\Spex\specifications\SpecificationInterface;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
abstract class AbstractNonCompositeSpecification implements SpecificationInterface
{
    protected string $type;

    /**
     * @return bool
     */
    public function isComposite(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    abstract public function isUnary(): bool;

    /**
     * @return bool
     */
    abstract public function isValueComparing(): bool;

    /**
     * @return bool
     */
    abstract public function isFieldsComparing(): bool;

    /**
     * @return bool
     */
    abstract public function isArrayComparing(): bool;
}