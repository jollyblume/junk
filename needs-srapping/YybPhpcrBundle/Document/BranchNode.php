<?php
namespace YoYogaBear\Bundle\PhpcrBundle\Document;

use YoYogaBear\Bundle\PhpcrBundle\Model\
{
    BranchNodeInterface,
    LinkNodesInterface
};
use YoYogaBear\Bundle\PhpcrBundle\Traits\
{
    NodeInterfaceTrait,
    ChildNodesInterfaceTrait,
    LinkNodesInterfaceTrait
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
 * BranchNode
 *
 * @PHPCR\Document()
 */
class BranchNode implements BranchNodeInterface, LinkNodesInterface
{
    use NodeInterfaceTrait, ChildNodesInterfaceTrait, LinkNodesInterfaceTrait;

    public function __construct(BranchNodeInterface $parentNode, string $nodename)
    {
        $this->nodeConstruct($parentNode, $nodename);
        $this->childNodesConstruct();
        $this->linkNodesConstruct();
    }
}
