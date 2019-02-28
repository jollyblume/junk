<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Model;

use YoYogaBear\Bundle\PhpcrBundle\Model\
{
    RootNodeInterface
};

/**
 * ArcNodeInterface
 */
interface LinkedRootNodeInterface
{
    /**
     * Get the linked root node
     *
     * @return RootNodeInterface The linked root node
     */
    public function getLinkedRootNode(): RootNodeInterface;
}
