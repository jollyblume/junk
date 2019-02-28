<?php
namespace YoYogaBear\Bundle\PhpcrBundle\Document;

use YoYogaBear\Bundle\PhpcrBundle\Model\
{
    RootNodeInterface,
    LinkNodesInterface,
    LinkableInterface
};
use YoYogaBear\Bundle\PhpcrBundle\Traits\
{
    RootNodeInterfaceTrait,
    ChildNodesInterfaceTrait,
    LinkNodesInterfaceTrait,
    LinkableInterfaceTrait
};
use Doctrine\Common\Collections\
{
    ArrayCollection
};
use Doctrine\ODM\PHPCR\Mapping\
{
    Annotations as PHPCR
};
/**
 * RootNode
 *
 * A root node is the branch node at the bottom of a Tree
 *
 * If the root node's parent node is an arc node, the root node is called a
 * ledge node.
 *
 * @PHPCR\Document(
 *   referenceable=true
 * )
 */
class RootNode implements RootNodeInterface, LinkNodesInterface, LinkableInterface
{
    use RootNodeInterfaceTrait, ChildNodesInterfaceTrait, LinkNodesInterfaceTrait, LinkableInterfaceTrait;

    public function __construct(string $identifier)
    {
        $this->nodeConstruct($identifier);
        $this->childNodesConstruct();
        $this->linkNodesConstruct();
    }
}
