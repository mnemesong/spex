<?php

namespace Mnemesong\Spex\specifications\abstracts;

trait ValueComparingSpecificationTrait
{
    protected string $field;

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }
}