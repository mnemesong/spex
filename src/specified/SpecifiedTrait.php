<?php

namespace Mnemesong\Spex\specified;

use Mnemesong\Spex\specifications\composites\MultipleCompositeSpecification;
use Mnemesong\Spex\specifications\SpecificationInterface;

trait SpecifiedTrait
{
    protected ?SpecificationInterface $specification = null;

    /**
     * @return SpecificationInterface|null
     */
    public function getSpecification(): ?SpecificationInterface
    {
        return $this->specification;
    }

    /**
     * @param SpecificationInterface|null $specification
     * @return self
     */
    public function where(?SpecificationInterface $specification): self
    {
        $clone = clone $this;
        $clone->specification = $specification;
        return $clone;
    }

    /**
     * @param SpecificationInterface $specification
     * @return $this
     */
    public function andWhere(SpecificationInterface $specification): self
    {
        if(empty($this->specification)) {
            return (clone $this)->where($specification);
        }
        if($this->specification->getType() === SpecificationInterface::TYPE_AND)
        {
            $spec = clone $this->specification;
            /* @var MultipleCompositeSpecification $spec */
            return (clone $this)->where($spec->withNewOne($specification));
        }
        return (clone $this)
            ->where(new MultipleCompositeSpecification('and', [$this->specification, $specification]));
    }

    /**
     * @param SpecificationInterface $specification
     * @return $this
     */
    public function orWhere(SpecificationInterface $specification): self
    {
        if(empty($this->specification)) {
            return (clone $this)->where($specification);
        }
        if($this->specification->getType() === SpecificationInterface::TYPE_OR)
        {
            $spec = clone $this->specification;
            /* @var MultipleCompositeSpecification $spec */
            return (clone $this)->where($spec->withNewOne($specification));
        }
        return (clone $this)
            ->where(new MultipleCompositeSpecification('or', [$this->specification, $specification]));
    }

}