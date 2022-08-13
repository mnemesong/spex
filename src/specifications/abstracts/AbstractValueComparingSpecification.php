<?php
declare(strict_types=1);

namespace Mnemesong\Spex\specifications\abstracts;

/**
 * @author Analoty Starodubtsev "Pantagruel74" Tostar74@mail.ru
 */
abstract class AbstractValueComparingSpecification extends AbstractNonCompositeSpecification
{
    protected string $field;
    protected string $type;

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
        return true;
    }

    /**
     * @return bool
     */
    public function isFieldsComparing(): bool
    {
        return false;
    }

    public function isArrayComparing(): bool
    {
        return false;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @return bool
     */
    abstract public function isNumericComparing():bool;

    /**
     * @return bool
     */
    abstract public function isStringComparing():bool;
}