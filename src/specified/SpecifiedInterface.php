<?php

namespace Mnemesong\Spex\specified;

use Mnemesong\Spex\specifications\SpecificationInterface;

interface SpecifiedInterface
{
    /**
     * @param SpecificationInterface|null $spec
     * @return $this
     */
    public function where(?SpecificationInterface $spec): self;

    /**
     * @return SpecificationInterface|null
     */
    public function getSpecification(): ?SpecificationInterface;

    /**
     * @param SpecificationInterface $specification
     * @return $this
     */
    public function andWhere(SpecificationInterface $specification): self;

    /**
     * @param SpecificationInterface $specification
     * @return $this
     */
    public function orWhere(SpecificationInterface $specification): self;

}