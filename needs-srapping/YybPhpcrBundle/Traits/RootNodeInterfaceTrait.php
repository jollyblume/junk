<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Traits;

use YoYogaBear\Bundle\PhpcrBundle\Document\
{
    ArcNode
};
use YoYogaBear\Bundle\PhpcrBundle\Model\
{
    NodeInterface,
    ArcNodeInterface,
    BranchNodeInterface
};
use YoYogaBear\Bundle\PhpcrBundle\Traits\
{
    NodeInterfaceCommonTrait
};
use Doctrine\ODM\PHPCR\Mapping\
{
    Annotations as PHPCR
};

/**
 * RootNodeInterfaceTrait
 *
 * Injects extra properties and methods to implement the RootNodeInterface
 */
trait RootNodeInterfaceTrait
{
    use NodeInterfaceCommonTrait;

    /**
     * @PHPCR\ReferenceOne(targetDocument="YoYogaBear\Bundle\PhpcrBundle\Model\ArcNodeInterface", strategy="hard")
     * @var ArcNodeInterface $parentNode
     */
    private $parentNode;

    /**
     * Perform trait construction
     *
     * This method must be called from classes using RootNodeInterfaceTrait.
     *
     * @param string $identifier Document identifier
     */
    protected function nodeConstruct(string $identifier)
    {
        $this->identifier = $identifier;
    }

    public function getParentDocument()
    {
        return $this->parentDocument;
    }

    public function getParentNode(): ?NodeInterface
    {
        $parentDocument = $this->parentDocument;
        return $parentDocument instanceof NodeInterface ? $parentDocument : $this->parentNode;
    }

    public function setParentNode(BranchNodeInterface $parentNode): self
    {
        $arcNode = new ArcNode($parentNode, $this->getNodeName(), $this);
        $this->parentNode = $arcNode;
        return $this;
    }
}
