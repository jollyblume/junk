<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Traits;

use YoYogaBear\Bundle\PhpcrBundle\Model\
{
    NodeInterface,
    HiddenChildInterface
};
use Doctrine\ODM\PHPCR\Mapping\
{
    Annotations as PHPCR
};
use Doctrine\Common\Collections\
{
    Collection,
    ArrayCollection
};

/**
 * ChildNodesInterfaceTrait
 *
 * Injects properties and methods to implement the ChildNodesInterface
 */
trait ChildNodesInterfaceTrait
{
    /**
     * @PHPCR\Children()
     * @var ArrayCollection $childNodes
     */
    private $childNodes;

    protected function childNodesConstruct()
    {
        $this->childNodes = new ArrayCollection();
    }

    public function getChildren(): Collection
    {
        return $this->childNodes;
    }

    public function getChildNodes(\Closure $predicate = null): Collection
    {
        $predicate = $predicate ?? function ($value) {
            return $value instanceof NodeInterface && !$value instanceof HiddenChildInterface;
        };

        return $this->childNodes->filter($predicate);
    }

    public function getHiddenNodes(): Collection
    {
        $predicate = $predicate ?? function ($value) {
            return $value instanceof NodeInterface && $value instanceof HiddenChildInterface;
        };

        return $this->getChildNodes($predicate);
    }
}
