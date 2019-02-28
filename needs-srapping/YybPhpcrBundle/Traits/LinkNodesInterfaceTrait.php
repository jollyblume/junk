<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Traits;

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
 * LinkNodesInterfaceTrait
 *
 * Injects properties and methods to implement the LinkNodesInterface
 */
trait LinkNodesInterfaceTrait
{
    /**
     * @PHPCR\ReferenceMany(targetDocument="YoYogaBear\Bundle\PhpcrBundle\Model\LinkableInterface", strategy="hard")
     * @var ArrayCollection $linkNodes
     */
    private $linkNodes;

    protected function linkNodesConstruct()
    {
        $this->linkNodes = new ArrayCollection();
    }

    public function getLinkNodes(): Collection
    {
        return $this->linkNodes;
    }
}
