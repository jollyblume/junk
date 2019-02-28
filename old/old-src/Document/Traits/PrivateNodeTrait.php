<?php

namespace OldApp\Document\Traits;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Document\RootNode;
use App\Document\PhpcrNodeInterface;
use App\Document\PhpcrChildrenInterface;
use App\Exception\ExceptionContext;
use App\Exception\NodeExistsException;
use App\Exception\PropImmutableException;
use App\Exception\OutOfScopeException;

/**
 * PrivateNodeTrait.
 *
 * Implements PhpcrNodeInterface getters
 *
 * This Trait is only used by PhpcrNodeTrait and SlugifyPhpcrNodeTrait. It
 * should never be used in a class.
 */
trait PrivateNodeTrait
{
    /**
     * Phpcr Nodename field.
     *
     * @var string
     * @PHPCR\Nodename()
     */
    private $nodename;

    /**
     * Phpcr Id field.
     *
     * @var string
     * @PHPCR\Id()
     */
    private $identifier;

    /**
     * Phpcr Parent Node field.
     *
     * @var PhpcrNodeInterface
     * @PHPCR\ParentDocument()
     */
    private $parent;

    /**
     * Get the Nodename portion of $this->identifier.
     *
     * Uses PathHelper::getNodename()
     *
     * @return string Nodename portion of $this->identifier
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    protected function getNodenameFromId(?string $identifier)
    {
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
    protected function getParentFromId(?string $identifier)
    {
        if (null === $identifier) {
            return '';
        }

        $parent = \PHPCR\Util\PathHelper::getParentPath($identifier);

        return $parent;
    }

    /**
     * Assert string is a valid absolute path.
     *
     * Uses PathHelper::assertValidAbsolutePath()
     *
     * @return string Nodename portion of $this->identifier
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    protected function assertValidAbsolutePath(string $identifier)
    {
        \PHPCR\Util\PathHelper::assertValidAbsolutePath($identifier);
    }

    /**
     * Set all sibling properties to null.
     *
     * Used by moveNode() to set new values without throwing array
     * PropImmutableException
     *
     * @return self
     */
    protected function resetSiblingPropertiesToNull()
    {
        $this->nodename = $this->parent = $this->identifier = null;

        return $this;
    }

    /**
     * Get the Phpcr Nodename.
     *
     * If Nodename is null, getNodename() returns a value generated from Id.
     *
     * If both Nodename and Id are null, getNodeName() returns ''.
     *
     * @return string Best attempt Nodename
     */
    public function getNodename()
    {
        $nodename = $this->nodename ?? $this->getNodenameFromId($this->identifier);

        return $nodename;
    }

    /**
     * Get the Phpcr Id.
     *
     * If Id is null, getId() returns a value generated from Nodename
     * and Parent Id. sprintf('%s/%s', Nodename|'', ParentId|'')
     *
     * If all the sibliing properties are null, getId() returns '/'.
     *
     * @return string Best attempt Phpcr Id
     */
    public function getId()
    {
        $identifier = $this->identifier;

        if (null === $identifier) {
            // Generate Id from parent/nodename
            $nodename = $this->nodename ?? '';
            $parentId = $this->getParentId();
            $identifier = sprintf('%s/%s', $parentId, $nodename);
        }

        return $identifier;
    }

    /**
     * Get the Parent Node.
     *
     * @return null|PhpcrNodeInterface
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Get the Id of the Phpcr Parent Node.
     *
     * @return string Phpcr Parent Node Id or ''
     */
    public function getParentId()
    {
        $parent = $this->parent;
        $parentId = null === $parent ? $this->getParentFromId($this->identifier) : $parent->getId();

        return $parentId;
    }

    /**
     * Set the Phpcr Nodename.
     *
     * @return self
     */
    protected function innerSetNodename(string $nodename)
    {
        return $this->moveNode(null, $nodename);
    }

    /**
     * Set the Phpcr Id.
     *
     * @throws PropImmutableException If any sibling properties are set
     *
     * @return self
     */
    protected function innerSetId(string $identifier)
    {
        $this->assertValidIdentifier($identifier);
        $this->assertValidAbsolutePath($identifier);
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Set the Phpcr Parent.
     *
     * @return self
     */
    public function setParent(?PhpcrChildrenInterface $parentNode)
    {
        if (null === $parentNode) {
            return $this->disconnectNode();
        }

        return $this->moveNode($parentNode);
    }

    /**
     * Test if this is the Root Node.
     */
    public function isRootNode()
    {
        return false;
    }

    /**
     * Get the RootNode.
     *
     * Recursively visits each Parent Node looking for the RootNode.
     *
     * Null is returned if the bottom Node in a graph has no Parent Node (the
     * graph is disconnected).
     *
     * @return null|RootNode
     */
    public function getRootNode()
    {
        if (true === $this->isRootNode()) {
            return $this;
        }

        // $rootNode = $this->rootNode;
        // if (null !== $rootNode) {
        //     return $rootNode;
        // }

        $parentNode = $this->getParent();
        if (null === $parentNode) {
            return null;
        }

        $rootNode = $parentNode->getRootNode();
        // if (null !== $rootNode) {
        //     $this->rootNode = $rootNode;
        // }

        return $rootNode;
    }

    protected function assertValidNodename(?string $nodename)
    {
        if (null === $nodename) {
            // null is valid
            return;
        }

        if (empty($nodename)) {
            // todo fix this debug text
            $context = new ExceptionContext(
                'exception.nodenameempty',
                'Nodename all ready set'
            );
            throw new NodeExistsException($context);
        }

        if (null !== $this->identifier) {
            $context = new ExceptionContext(
                'exception.propimmutable',
                'Unable to set nodename, identifier not NULL'
            );

            throw new PropImmutableException($context);
        }
    }

    protected function assertValidParent(?PhpcrChildrenInterface $parent)
    {
        if (null === $parent) {
            // null is valid
            return;
        }

        if (null !== $this->identifier) {
            $context = new ExceptionContext(
                'exception.propimmutable',
                'Unable to set parent, identifier not NULL'
            );

            throw new PropImmutableException($context);
        }
    }

    protected function assertValidIdentifier(string $identifier)
    {
        if ('/' !== $this->getId()) {
            // todo fix this debug text
            $context = new ExceptionContext(
                'exception.identifierset',
                'Id all ready set'
            );
            throw new PropImmutableException($context);
        }

        // todo use PathHelper to test identifier
        if ('/' === $identifier || empty($identifier)) {
            // todo fix this debug text
            $context = new ExceptionContext(
                'exception.rootnootexists',
                'can not set id to "\"'
            );
            throw new NodeExistsException($context);
        }
    }

    public function disconnectNode() {
        $oldParent = $this->parent;
        if (null === $oldParent) {
            // Nothing to do
            return $this;
        }

        $this->parent = null;
        if ($oldParent->offsetExists($this->nodename)) {
            $oldParent->removeElement($this);
        }

        return $this;
    }

    public function moveNode(?PhpcrChildrenInterface $newParent = null, ?string $newNodename = null)
    {
        $this->assertValidNodename($newNodename);
        $this->assertValidParent($newParent);

        $nodename = $newNodename ?? $this->nodename;
        $isNodenameChanging = ($nodename !== $this->nodename);
        $oldParent = $this->parent;
        $parent = $newParent ?? $oldParent;
        $isParentChanging = ($parent !== $oldParent);
        
        if (!$isParentChanging && !$isNodenameChanging) {
            // Nothing to do
            return $this;
        }

        if (null !== $oldParent) {
            // Remove Node from Parent
            $oldParent->removeElement($this);
        }

        $this->nodename = $nodename;

        if (null !== $parent) {
            $this->parent = $parent;
            $parent->add($this);
        }

        return $this;
    }
}
