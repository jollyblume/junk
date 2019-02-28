<?php

namespace App\Traits;

use App\Model\NodeInterface;
use App\Exception\ExceptionContext;
use App\Exception\NodeExistsException;
use App\Exception\OutOfScopeException;
use App\Exception\UnexpectedNullException;
use App\Exception\NodenameMissingException;
use Doctrine\Common\Collections\ArrayCollection;

trait ParentNodeTrait
{
    use ComposedCollectionTrait;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return string
     */
    abstract protected function getChildrenFromStore();

    /**
     * Get the composed collection.
     *
     * Used by ComposedCollectionTrait
     *
     * @return ArrayCollection
     */
    private function getComposedCollection()
    {
        return $this->getChildrenFromStore();
    }

    /**
     * Assert a node can be added to collection.
     *
     * @throws NodenameMissingException
     */
    private function assertNodeCanBeAdded(NodeInterface $node)
    {
        $nodename = $node->getNodename();
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

        // this should not be needed, add moved child if needed?
        // $nodeParent = $node->getParent();
        // if (null !== $nodeParent && $this !== $nodeParent) {
        //     // Wrong child?
        //     $context = new ExceptionContext(
        //         'exception.outofscope',
        //         'Child Node belongs to a different bag'
        //     );
        //     throw new OutOfScopeException($context);
        // }
    }

    /**
     * Add a child Node to the parent collection.
     *
     * Move child from another parent, if needed
     *
     * This method interacts directly with the composed collection
     *
     * @param NodeInterface $child
     *
     * @throws NodenameMissingException If Nodename not set
     * @throws NodeExistsException If Node all ready exists
     *
     * @return self
     */
    protected function addChild(NodeInterface $child)
    {
        $this->assertNodeCanBeAdded($child);

        $nodename = $child->getNodename();
        $children = $this->getComposedCollection();
        $children->set($nodename, $child);

        $childParent = $child->getParent();
        if (null === $childParent || $this !== $childParent) {
            // moves node if needed
            $child->setParent($this);
        }

        return $this;
    }

    /**
     * Add a child Node to the parent collection, if missing.
     *
     * This method interacts directly with the composed collection
     *
     * @param NodeInterface $child
     *
     * @return self
     */
    protected function addChildIfMissing(NodeInterface $child)
    {
        if (!$this->hasChild($child)) {
            $this->addChild($child);
        }

        return $this;
    }

    /**
     * Check if Child Node exists.
     *
     * @param NodeInterface $node
     *
     * @return bool
     */
    protected function hasChild(NodeInterface $node)
    {
        $children = $this->getComposedCollection();

        return $children->containsKey($node->getNodename());
    }

    /**
     * Check if Child Nodename exists.
     *
     * @param string
     *
     * @return bool
     */
    protected function hasChildKey(string $nodename)
    {
        $children = $this->getComposedCollection();

        return $children->containsKey($nodename);
    }

    /**
     * Assert node can be removed from collection.
     *
     * @throws OutOfScopeException
     */
    private function assertNodeCanBeRemoved(NodeInterface $node)
    {
        $nodeParent = $node->getParent();
        if (null !== $nodeParent && $this !== $nodeParent) {
            // Wrong child?
            $context = new ExceptionContext(
                'exception.outofscope',
                'Child Node belongs to a different bag'
            );
            throw new OutOfScopeException($context);
        }
    }

    /**
     * Remove a child element.
     *
     * @param NodeInterface $node
     *
     * @return null|NodeInterface Removed element
     */
    protected function removeChild(NodeInterface $node)
    {
        $this->assertNodeCanBeRemoved($node);

        if (!$this->hasChild($node)) {
            // Nothing to do
            return null;
        }

        $children = $this->getComposedCollection();
        $removed = $children->remove($node->getNodename());

        // if (null === $removed || $removed !== $node) {
        //     // Put it back
        //     $this->addChild($removed);
        //
        //     // Wrong child in bag?
        //     $context = new ExceptionContext(
        //         'exception.outofscope',
        //         'Child Node belongs to a different bag. should never get this exception?'
        //     );
        //     throw new OutOfScopeException($context);
        // }

        if (null !== $node->getParent()) {
            $node->setParent(null);
        }

        // todo move node instead of removing it

        return $removed;
    }

    /**
     * Remove a child node.
     *
     * @param string $nodename
     *
     * @return null|NodeInterface Removed node
     */
    protected function removeChildKey(string $nodename)
    {
        $node = $this->getChild($nodename);

        if (null === $node) {
            return null;
        }

        return $this->removeChild($node);
    }

    /**
     * Set a Child node and it's Nodename.
     *
     * @param string
     * @param NodeInterface
     *
     * @return self
     */
    protected function setChild(?string $nodename, NodeInterface $child)
    {
        $childNodename = $child->getNodename();
        if (null !== $nodename && $nodename !== $childNodename) {
            $context = new ExceptionContext(
                'exception.outofscope',
                '$nodename must equal $child->nodename, or be null'
            );
            throw new OutOfScopeException($context);
        }

        if (null === $nodename && null === $childNodename) {
            $context = new ExceptionContext(
                'exception.unexpectednull',
                '$child must have a nodename set'
            );
            throw new UnexpectedNullException($context);
        }

        if (null !== $nodename && null === $childNodename) {
            $child->setNodename($nodename);
        }

        $this->addChild($child);
        return $this;
    }

    /*
     * Remove a child node.
     *
     * @param string $nodename
     *
     * @return null|NodeInterface Removed node
     */
    protected function getChild(string $nodename): ?NodeInterface
    {
        $children = $this->getComposedCollection();

        return $children->get($nodename);
    }
}
