<?php

namespace App\Document\Traits;

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

    // /**
    //  * @var RootNode
    //  */
    // private $rootNode;

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
     * @throws PropImmutableException If Nodename or Id all ready set
     *
     * @return self
     */
    protected function innerSetNodename(string $nodename)
    {
        if (empty($nodename)) {
            // todo fix this debug text
            $context = new ExceptionContext(
                'exception.nodenameempty',
                'Nodename all ready set'
            );
            throw new NodeExistsException($context);
        }

        if ('' !== $this->getNodename()) {
            // todo fix this debug text
            $context = new ExceptionContext(
                'exception.nodenameset',
                'Nodename all ready set'
            );
            throw new PropImmutableException($context);
        }

        $this->nodename = $nodename;

        return $this;
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

        $this->assertValidAbsolutePath($identifier);
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Set the Phpcr Parent.
     *
     * @throws PropImmutableException If Parent or Id all ready set
     *
     * @return self
     */
    public function setParent(PhpcrNodeInterface $parentNode)
    {
        if ('' !== $this->getParentId()) {
            // todo fix this debug text
            $context = new ExceptionContext(
                'exception.parentset',
                'Parent all ready set'
            );
            throw new PropImmutableException($context);
        }

        $this->parent = $parentNode;

        return $this;
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

    protected function assertNotDisconnected()
    {
        if (null === $this->getParent() || '' === $this->getNodename()) {
            $context = new ExceptionContext(
                'exception.outofscope',
                'Disconnected Nodes can not be moved'
            );

            throw new OutOfScopeException($context);
        }
    }

    // protected function assertInstanceOfPhpcrNodeInterface()
    // {
    //     if (!$this instanceof PhpcrNodeInterface) {
    //         $context = new ExceptionContext(
    //             'exception.missinginterface',
    //             'Movable Nodes must implement PhpcrNodeInterface'
    //         );
    //
    //         throw new MissingInterfaceException($context);
    //     }
    // }

    protected function assertOneOrBothParametersSet(?PhpcrChildrenInterface $newParent = null, ?string $newNodename = null)
    {
        if (null === $newParent && null === $newNodename) {
            $context = new ExceptionContext(
                'exception.outofscope',
                'No parameters?'
            );

            throw new OutOfScopeException($context);
        }
    }

    public function moveNode(?PhpcrChildrenInterface $newParent = null, ?string $newNodename = null)
    {
        // This should not be needed
        // $this->assertInstanceOfPhpcrNodeInterface();
        $this->assertOneOrBothParametersSet($newParent, $newNodename);
        $this->assertNotDisconnected();

        $nodename = $newNodename ?? $this->getNodename();
        $oldParent = $this->getParent();
        $parent = $newParent ?? $oldParent;

<<<<<<< HEAD
        $removeMethod = $oldParent->computeMethodName('removeNode');
        $oldParent->$removeMethod($this);

        $this->resetSiblingPropertiesToNull();

        $this->setNodename($nodename);
        $addMethod = $parent->computeMethodName('addNode');
        $parent->$addMethod($this);
=======
        $oldParent->removeElement($this);

        $this->resetSiblingPropertiesToNull();

        $parent->set($nodename, $this);
>>>>>>> move-collection-to-children

        return $this;
    }
}
