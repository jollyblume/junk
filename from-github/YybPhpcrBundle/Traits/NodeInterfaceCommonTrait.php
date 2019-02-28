<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Traits;

use YoYogaBear\Bundle\PhpcrBundle\Model\
{
    ChildNodesInterface,
    LinkNodesInterface,
    LinkedRootNodeInterface,
    RootNodeInterface,
    LinkableInterface
};
use Doctrine\ODM\PHPCR\Mapping\
{
    Annotations as PHPCR
};

/**
 * NodeInterfaceCommonTrait
 *
 * Injects common properties and methods to implement the NodeInterface
 */
trait NodeInterfaceCommonTrait
{
    /**
     * @PHPCR\Nodename()
     * @var string $nodename
     */
    private $nodename;

    /**
     * @PHPCR\Id()
     * @var string $identifier
     */
    private $identifier;

    /**
     * @PHPCR\ParentDocument()
     * @var object $parentDocument
     */
    private $parentDocument;

    public function getOutboundProviders(): array
    {
        $outboundProviders = ['getParentNode'];

        if ($this instanceof ChildNodesInterface) {
            $outboundProviders[] = 'getChildNodes';
        }

        if ($this instanceof LinkNodesInterface) {
            $outboundProviders[] = 'getLinkNodes';
        }

        if ($this instanceof LinkedRootNodeInterface) {
            $outboundProviders[] = 'getLinkedRootNode';
        }

        return $outboundProviders;
    }

    public function getNodeName(): string
    {
        $nodename = $this->nodename;

        if (null === $nodename) {
            // If the nodename is not set, generate it from the document identifier
            $identifier = $this->identifier ?? '';
            $strrpos = strrpos($identifier, '/');
            if (false !== $strrpos) {
                $nodename = substr($identifier, $strrpos + 1);
            }
        }

        return $nodename ?? '';
    }

    public function getDocumentId(): string
    {
        $identifier = $this->identifier;

        if (null === $identifier) {
            // Generate $identifier from the nodename and the parent document's path
            $identifier = sprintf('%s/%s', $this->parentDocument->getDocumentId(), $this->nodename);
        }

        return $identifier;
    }

    public function getNodePath(): string
    {
        $ledge = $this->getLedgeNode();
        $ledgePrefix = $ledge->getDocumentId();
        $nodepath = $this->getDocumentId();

        // Remove $ledgePrefix from $nodepath (paths are relative to a ledge node)
        if ($ledgePrefix === substr($nodepath, 0, strlen($ledgePrefix))) {
            $nodepath = '/'. ltrim(substr($nodepath, strlen($ledgePrefix)), '/');
        }

        if (!$ledge->isRootNode()) {
            $nodepath = rtrim($this->getParentNode()->getNodePath() . $nodepath, '/');
        }

        return $nodepath ?? '';
    }

    public function getRootNode(): RootNodeInterface
    {
        return $this->isRootNode() ? $this : $this->getParentNode()->getRootNode();
    }

    public function getLedgeNode(): RootNodeInterface
    {
        return $this->isLedgeNode() ? $this : $this->getParentNode()->getLedgeNode();
    }

    public function isRootNode(): bool
    {
        return $this instanceof RootNodeInterface && null === $this->getParentNode();
    }

    public function isLedgeNode(): bool
    {
        $isLedgeNode =
            $this instanceof RootNodeInterface &&
            null !== $this->getParentNode() &&
            $this->getParentDocument() !== $this->getParentNode()
        ;
        $isRootNode = $this->isRootNode();
        return $isLedgeNode || $isRootNode;
    }

    public function isLinkableNode(): bool
    {
        return $this instanceof LinkableInterface;
    }
}
