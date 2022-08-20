<?php

namespace Mnemesong\Spex\specifications\abstracts;

trait SpecificationTrait
{
    protected string $type;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}