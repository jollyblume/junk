<?php
namespace YoYogaBear\Bundle\PhpcrBundle\Document;

use YoYogaBear\Bundle\PhpcrBundle\Model\
{
    NodeInterface,
    BranchNodeInterface
};
use YoYogaBear\Bundle\PhpcrBundle\Traits\
{
    NodeInterfaceTrait
};
use Doctrine\ODM\PHPCR\Mapping\
{
    Annotations as PHPCR
};

/**
 * Node
 *
 * @PHPCR\Document()
 */
class Node implements NodeInterface
{
    use NodeInterfaceTrait;

    public function __construct(BranchNodeInterface $parentNode, string $nodename)
    {
        $this->nodeConstruct($parentNode, $nodename);
    }
}
