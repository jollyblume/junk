<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Traits;

use YoYogaBear\Bundle\PhpcrBundle\Model\
{
    RootNodeInterface
};
use Doctrine\ODM\PHPCR\Mapping\
{
    Annotations as PHPCR
};

/**
 * ArcNodeInterfaceTrait
 *
 * Injects properties and methods to implement the ArcNodeInterface
 */
trait LinkedRootNodeInterfaceTrait
{
    /**
     * @PHPCR\ReferenceOne(targetDocument="YoYogaBear\Bundle\PhpcrBundle\Model\RootNodeInterface", strategy="hard")
     * @var RootNodeInterface $linkedRootNode
     */
    private $linkedRootNode;

    public function getLinkedRootNode(): RootNodeInterface
    {
        return $this->linkedRootNode;
    }
}
