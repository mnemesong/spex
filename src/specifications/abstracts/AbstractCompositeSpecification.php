<?php
declare(strict_types=1);

namespace Mnemesong\Spex\specifications\abstracts;

use Mnemesong\Spex\specifications\SpecificationInterface;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
abstract class AbstractCompositeSpecification implements SpecificationInterface
{
    /**
     * @return bool
     */
    public function isComposite(): bool
    {
        return true;
    }

    /**
     * @return int
     */
    abstract public function count(): int;

    /**
     * @return bool
     */
    abstract public function isUnary(): bool;

    /**
     * @return bool
     */
    abstract public function isMultiple(): bool;
}