<?php

namespace Mnemesong\Spex\specified;

use Mnemesong\Spex\specifications\SpecificationInterface;

interface SpecifiedInterface
{
    public function where(?SpecificationInterface $spec): self;

    public function getSpecification(): ?SpecificationInterface;

    public function andWhere(SpecificationInterface $specification): self;

    public function orWhere(SpecificationInterface $specification): self;
}