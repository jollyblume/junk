<?php

namespace App\Collections;

use Doctrine\Common\Collections\Collection;
use App\Exception\ExceptionContext;
use App\Exception\PropImmutableException;
use App\Model\NodeInterface;

class ReadOnlyCollectionWrapper implements ComposedCollectionInterface
{
    use ComposedCollectionTrait;

    /**
     * Composed collection.
     *
     * @var Collection
     */
    private $composedCollection;

    /**
     * Constructor
     *
     * @param Collection The collection to compose
     *
     * @return void
     */
    public function __construct(Collection $composedCollection) {
        $this->composedCollection = $composedCollection;
    }

    /**
     * Get the composed collection.
     *
     * @return Collection
     */
    protected function getComposedCollection()
    {
        return $this->composedCollection;
    }

    /**
     * Add a child Node to the parent collection.
     *
     * @param NodeInterface $child ignored
     *
     * @throws PropImmutableException Always
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function addChild(NodeInterface $child)
    {
        $context = new ExceptionContext(
            'exception.propimmutable',
            'Read only'
        );

        throw new PropImmutableException($context);
    }

    /**
     * Add a child Node to the parent collection, if missing.
     *
     * @param NodeInterface $child ignored
     * @throws PropImmutableException Always
     */
    protected function addChildIfMissing(NodeInterface $child)
    {
        $this->addChild($child);
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
     * Remove a child element.
     *
     * @throws PropImmutableException Always
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function removeChild(NodeInterface $node)
    {
        $context = new ExceptionContext(
            'exception.propimmutable',
            'Read only'
        );

        throw new PropImmutableException($context);
    }

    /**
     * Remove a child node.
     *
     * @throws PropImmutableException Always
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function removeChildKey(string $nodename)
    {
        $context = new ExceptionContext(
            'exception.propimmutable',
            'Read only'
        );

        throw new PropImmutableException($context);
    }

    /**
     * Set a Child node and it's Nodename.
     *
     * @throws PropImmutableException Always
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function setChild(?string $nodename, NodeInterface $child)
    {
        $context = new ExceptionContext(
            'exception.propimmutable',
            'Read only'
        );

        throw new PropImmutableException($context);
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
