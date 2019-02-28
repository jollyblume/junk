<?php

namespace App\Traits;

use App\Exception\ExceptionContext;
use App\Exception\NodeExistsException;
use App\Exception\PropImmutableException;
use App\Model\NodeInterface;
use App\Model\ParentNodeInterface;
use App\Document\RootNode;

/**
 * NodeTrait.
 *
 * Implements App\Model\NodeInterface
 */
trait NodeTrait
{
    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return string
     */
    abstract protected function getNodenameFromStore();

    /**
     * Low-level setter implemented by persistence layer.
     *
     * @param string
     *
     * @return self
     */
    abstract protected function setNodenameToStore(string $nodename);

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return ParentNodeInterface
     */
    abstract protected function getParentFromStore();

    /**
     * Low-level setter implemented by persistence layer.
     *
     * @param ParentNodeInterface
     *
     * @return self
     */
    abstract protected function setParentToStore(?ParentNodeInterface $parent);

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return string
     */
    abstract protected function getIdentifierFromStore();

    /**
     * Low-level setter implemented by persistence layer.
     *
     * @param string
     *
     * @return self
     */
    abstract protected function setIdentifierToStore(string $identifier);

    /**
     * Assert identifier is not set.
     *
     * @throws PropImmutableException If identifier is set
     */
    private function assertIdentifierNotSet()
    {
        $identifier = $this->getIdentifierFromStore();
        if (null !== $identifier) {
            $context = new ExceptionContext(
                'exception.propimmutable',
                'Identifier must be empty'
            );

            throw new PropImmutableException($context);
        }
    }

    /**
     * Assert nodename & parent are not set.
     *
     * @throws PropImmutableException If identifier is set
     */
    private function assertParentAndNodenameNotSet()
    {
        $nodename = $this->getNodenameFromStore();
        $parent = $this->getParentFromStore();
        if (null !== $nodename || null !== $parent) {
            $context = new ExceptionContext(
                'exception.propimmutable',
                'Nodename and parent must be empty'
            );

            throw new PropImmutableException($context);
        }
    }

    /**
     * Assert string is a valid absolute path.
     *
     * Uses PathHelper::assertValidAbsolutePath()
     *
     * @return string Nodename portion of $this->identifier
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    private function assertValidAbsolutePath(string $identifier)
    {
        \PHPCR\Util\PathHelper::assertValidAbsolutePath($identifier);
    }

    /**
     * Get the nodename portion of identifier.
     *
     * Uses PathHelper::getNodename()
     *
     * @return string Nodename portion of $this->identifier
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    private function getNodenameFromId()
    {
        $identifier = $this->getIdentifierFromStore();
        if (null === $identifier) {
            return '';
        }

        $nodename = \PHPCR\Util\PathHelper::getNodeName($identifier);

        return $nodename;
    }

    /**
     * Get the Parent portion of $this->identifier.
     *
     * Uses PathHelper::getParentPath()
     *
     * @return string Nodename portion of $this->identifier
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    private function getParentFromId()
    {
        $identifier = $this->getIdentifierFromStore();
        if (null === $identifier) {
            return '';
        }

        $parent = \PHPCR\Util\PathHelper::getParentPath($identifier);

        return $parent;
    }

    /**
     * Get the Node's Nodename.
     *
     * If Nodename is null, getNodename() returns a value generated from Id.
     *
     * If both Nodename and Id are null, getNodeName() returns ''.
     *
     * @return string Best attempt Nodename
     */
    public function getNodename()
    {
        $storeNodename = $this->getNodenameFromStore();
        if (null === $storeNodename) {
            // Generate Nodename from Identifier || ''
            $storeNodename = $this->getNodenameFromId();
        }

        return $storeNodename;
    }

    /**
     * Set the Node's Nodename.
     *
     * @throws PropImmutableException If Identifier all ready set
     *
     * @param string
     *
     * @return self
     */
    public function setNodename(string $nodename)
    {
        $this->moveNode(null, $nodename);

        return $this;
    }

    private function getIdFromNodenameParent()
    {
        $parentId = $this->getParentIdentifier();
        $nodename = $this->getNodename();
        $identifier = sprintf('%s/%s', $parentId, $nodename);

        return $identifier;
    }

    /**
     * Get the Node's Identifier (Id).
     *
     * If Id is null, getIdentifier() returns a value generated from Nodename
     * and Parent Id. sprintf('%s/%s', Nodename|'', ParentId|'')
     *
     * If all the sibliing properties are null, getId() returns '/'.
     *
     * @return string Best attempt Phpcr Id
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function getIdentifier()
    {
        $storeIdentifier = $this->getIdentifierFromStore();
        if (null === $storeIdentifier) {
            $storeIdentifier = $this->getIdFromNodenameParent();
        }

        if ($this instanceof RootNode) {
            return $storeIdentifier;
        }

        return $this->getIdFromNodenameParent();
    }

    /**
     * Set the Node's Identifier (Id).
     *
     * @throws PropImmutableException If parent or nodename is set
     *
     * @return self
     */
    public function setIdentifier(string $identifier)
    {
        $this->assertIdentifierNotSet();
        $this->assertParentAndNodenameNotSet();
        $this->assertValidAbsolutePath($identifier);

        $this->setIdentifierToStore($identifier);

        return $this;
    }

    /**
     * Get the Parent Node.
     *
     * @return null|ParentNodeInterface
     */
    public function getParent()
    {
        $parent = $this->getParentFromStore();

        return $parent;
    }

    /**
     * Get the Identifier (Id) of the Parent Node.
     *
     * If Parent is null, getParentId() returns a value generated from Id or ''.
     *
     * @return string Parent Node Id or ''
     */
    public function getParentIdentifier()
    {
        $parent = $this->getParentFromStore();

        if (null === $parent) {
            return $this->getParentFromId();
        }

        if ($parent instanceof NodeInterface) {
            $parentId = $parent->getIdentifier();
        }
        if (!$parent instanceof NodeInterface) {
            $parentId = $parent->getId();
        }

        return $parentId;
    }

    /**
     * Set the Parent Node.
     *
     * Changing the parent moves the Node.
     *
     * Setting the parent to null disconnects the Node
     *
     * @throws PropImmutableException If Identifier all ready set
     *
     * @return self
     */
    public function setParent(?ParentNodeInterface $parentNode)
    {
        if (null === $parentNode) {
            $this->disconnectNode();
        }
        if (null !== $parentNode) {
            $this->moveNode($parentNode, null);
        }

        return $this;
    }

    /**
     * Disconnect the Node from its graph.
     *
     * @return self
     */
    public function disconnectNode()
    {
        $storeParent = $this->getParentFromStore();
        if (null === $storeParent) {
            // Nothing to do
            return null;
        }

        $storeNodename = $this->getNodenameFromStore();
        if (null === $storeNodename) {
            // todo throw (shouldn't be possible if parent is set)
        }

        $this->setParentToStore(null);
        if (isset($storeParent[$storeNodename])) {
            unset($storeParent[$storeNodename]);
        }

        return $this;
    }

    private function assertNodenameNotEmpty(?string $nodename)
    {
        if ('' === $nodename) {
            $context = new ExceptionContext(
                'exception.nodeexists',
                'Nodename can not be empty'
            );

            throw new NodeExistsException($context);
        }
    }

    /**
     * Move Node to another Parent and/or rename Node.
     *
     * @param null|ParentNodeInterface
     * @param null|string
     *
     * @return self
     */
    public function moveNode(?ParentNodeInterface $newParent = null, ?string $newNodename = null)
    {
        // $this->assertIdentifierNotSet();
        $this->assertNodenameNotEmpty($newNodename);

        $storeNodename = $this->getNodenameFromStore();
        $nodename = $newNodename ?? $storeNodename;
        $isNodenameChanging = ($nodename !== $storeNodename);
        $storeParent = $this->getParentFromStore();
        $parent = $newParent ?? $storeParent;
        $isParentChanging = ($parent !== $storeParent);

        if (!$isParentChanging && !$isNodenameChanging) {
            // Nothing to do
            return null;
        }

        $this->disconnectNode();
        if (null !== $nodename) {
            $this->setNodenameToStore($nodename);
        }
        if (null !== $parent) {
            $this->setParentToStore($parent);
            // todo need parentnodeinterface flushed out first
        }
        if (null !== $nodename && !isset($parent[$nodename])){
            $parent[] = $this;
        }

        return $this;
    }
}
