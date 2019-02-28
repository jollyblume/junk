<?php

namespace App\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Doctrine\Common\Collections\ArrayCollection;
use App\Document\Traits\PhpcrChildrenTrait;
use App\Traits\ComputeMethodNameTrait;
use App\Document\Traits\PhpcrNodeTrait;
use App\NodeTypeInterface;

/**
 * RootNode.
 *
 * @PHPCR\Document(childClasses={"App\Document\TreeInterface"})
 */
class RootNode implements PhpcrChildrenInterface, NodeTypeInterface
{
    use PhpcrNodeTrait, PhpcrChildrenTrait, ComputeMethodNameTrait;

    /**
     * Constructor.
     *
     * Initializes $this->children from PhpcrChildrenTrait
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    public function getNodeType()
    {
        return 'Tree';
    }

    /**
     * Add a Tree Node.
     *
     * @param PhpcrNodeInterface $treeNode TreeNode to add
     *
     * @return self
     */
    public function addTreeNode(TreeInterface $treeNode)
    {
        $this->addChildIfMissing($treeNode);

        return $this;
    }

    /**
     * Check if Tree Node exists.
     *
     * @param $TreeInterface $treeNode
     *
     * @return bool
     */
    public function hasTreeNode(TreeInterface $treeNode)
    {
        return $this->hasChild($treeNode);
    }

    /**
     * Check if Tree Node exists.
     *
     * @param string $nodename
     *
     * @return bool
     */
    public function hasTreeName(string $nodename)
    {
        return $this->hasChildKey($nodename);
    }

    /**
     * Remove Tree Node.
     *
     * @param $TreeInterface $treeNode Player to remove
     *
     * @return null|$TreeInterface Null if Player doesn't exist
     *                             Otherwise, removed Player Node
     */
    public function removeTreeNode(TreeInterface $treeNode)
    {
        return $this->removeChild($treeNode);
    }

    /**
     * Remove the Tree Node by name.
     *
     * @param string $nodename Player name
     *
     * @return null|$TreeInterface Null if Tree doesn't exist
     *                             Otherwise, removed Tree Node
     */
    public function removeTreeName(string $nodename)
    {
        return $this->removeChildKey($nodename);
    }

    /**
     * Get a Tree Node.
     *
     * @param string $nodename Tree Nodename to find
     *
     * @return null|$TreeInterface
     */
    public function getTreeNode(string $nodename)
    {
        $children = $this->getChildren();

        return $children->get($nodename);
    }

    /**
     * Test if this is the Root Node.
     */
    public function isRootNode()
    {
        return true;
    }
}
