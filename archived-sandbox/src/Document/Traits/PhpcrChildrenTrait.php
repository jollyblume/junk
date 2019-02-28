<?php

namespace App\Document\Traits;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Doctrine\Common\Collections\ArrayCollection;
use App\Exception\ExceptionContext;
use App\Exception\NodeExistsException;
use App\Exception\NodenameMissingException;
use App\Document\PhpcrNodeInterface;
use App\Document\PhpcrChildrenInterface;
use App\Traits\ComposedCollectionTrait;

/**
 * PhpcrChildrenTrait.
 *
 * Implements PhpcrChildrenInterface
 */
trait PhpcrChildrenTrait
{
    use ComposedCollectionTrait;

    /**
     * Phpcr Children collection.
     *
     * @PHPCR\Children()
     *
     * @var Collection
     */
    private $children;

    /**
     * Get the Phpcr Children collection.
     *
     * @return Collection The Phpce Children collection
     */
    public function getChildren()
    {
        $children = $this->children;
        if (null === $children) {
            $children = new ArrayCollection();
            $this->children = $children;
        }

        return $children;
    }

    /**
     * Get the composed collection.
     *
     * @return ArrayCollection
     */
    protected function getComposedCollection()
    {
        return $this->children;
    }

    /**
     * Add a Phpcr Node to a parent Phpcr Children collection.
     *
     * @param PhpcrNodeInterface $child
     *
     * @throws NodeExistsException If Node all ready exists in Children
     *
     * @return self
     */
    protected function addChild(PhpcrNodeInterface $child)
    {
        $children = $this->getChildren();
        $nodename = $child->getNodename();

        if (empty($nodename)) {
            // todo fix this debug text
            $context = new ExceptionContext(
                'exception.nodenamemissing',
                'Nodename is required'
            );

            throw new NodenameMissingException($context);
        }

        if ($this->hasChildKey($nodename)) {
            // todo fix this debug text
            $context = new ExceptionContext(
                'exception.nodeexists',
                'Child all ready exists'
            );

            throw new NodeExistsException($context);
        }

        if (null === $child->getParent()) {
            $child->setParent($this);
        }
        $children->set($nodename, $child);

        return $this;
    }

    /**
     * Add a Phpcr Node to a parent Phpcr Children collection, if missing.
     *
     * @param PhpcrNodeInterface $child
     *
     * @return self
     */
    protected function addChildIfMissing(PhpcrNodeInterface $child)
    {
        $nodename = $child->getNodename();

        if (!$this->hasChildKey($nodename)) {
            $this->addChild($child);
        }

        return $this;
    }

    /**
     * Check if Child Node exists.
     *
     * @param PhpcrNodeInterface $node
     *
     * @return bool
     */
    protected function hasChild(PhpcrNodeInterface $node)
    {
        $children = $this->getChildren();

        return $children->containsKey($node->getNodename());
    }

    /**
     * Check if Child Nodename exists.
     *
     * @param PhpcrNodeInterface $node
     *
     * @return bool
     */
    protected function hasChildKey(string $nodename)
    {
        $children = $this->getChildren();

        return $children->containsKey($nodename);
    }

    /**
     * Remove a child element.
     *
     * @param PhpcrNodeInterface $node
     *
     * @return null|PhpcrNodeInterface Removed element
     */
    protected function removeChild(PhpcrNodeInterface $node)
    {
        $children = $this->getChildren();

        return $children->remove($node->getNodename());
    }

    /**
     * Remove a child element.
     *
     * @param string $nodename
     *
     * @return null|PhpcrNodeInterface Removed element
     */
    protected function removeChildKey(string $nodename)
    {
        $children = $this->getChildren();

        return $children->remove($nodename);
    }

    /**
     * Set a Child node and set Nodename.
     *
     * @param string
     * @return PhpcrNodeInterface
     */
    protected function setChild(string $nodename, PhpcrNodeInterface $child)
    {
        $child->setNodename($nodename);
        $this->addChild($child);
    }

    /*
     * Remove a child element.
     *
     * @param string $nodename
     *
     * @return null|PhpcrNodeInterface Removed element
     */
    protected function getChild(string $nodename): ?PhpcrNodeInterface
    {
        $children = $this->getChildren();

        return $children->get($nodename);
    }
}
