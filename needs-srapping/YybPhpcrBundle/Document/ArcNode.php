<?php
namespace YoYogaBear\Bundle\PhpcrBundle\Document;

use YoYogaBear\Bundle\PhpcrBundle\Model\
{
    ArcNodeInterface,
    BranchNodeInterface,
    RootNodeInterface
};
use YoYogaBear\Bundle\PhpcrBundle\Traits\
{
    NodeInterfaceTrait,
    LinkedRootNodeInterfaceTrait,
    LinkableInterfaceTrait
};
use Doctrine\ODM\PHPCR\Mapping\
{
    Annotations as PHPCR
};

/**
 * ArcNode
 *
 * An arc node links a branch node to a ledge node
 *
 * @PHPCR\Document(
 *   referenceable=true
 * )
 */
class ArcNode implements ArcNodeInterface
{
    use NodeInterfaceTrait, LinkedRootNodeInterfaceTrait, LinkableInterfaceTrait;

    public function __construct(BranchNodeInterface $parentNode, string $nodename, RootNodeInterface $linkedRootNode)
    {
        $this->nodeConstruct($parentNode, $nodename);
        $this->linkedRootNode = $linkedRootNode;
    }
}
