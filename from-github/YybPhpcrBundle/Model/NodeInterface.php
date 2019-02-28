<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Model;

use YoYogaBear\Bundle\PhpcrBundle\Model\
{
    RootNodeInterface
};

/**
 * NodeInterface
 *
 * Implementing NodeInterface identifies a document class as a node.
 */
interface NodeInterface
{
    /**
     * Get the list of outbound node providers
     *
     * Outbound node providers are getter methods that return reachable nodes.
     *
     * Visitors can use these providers to build a list of reachable nodes.
     *
     *  getter              reachable node type
     *  ------              -------------------
     *  getParentNode       Returns the parent node and is hard-wired into every
     *                      node and is always included as index 0.
     *
     *  getChildNodes       Returns a collection of child nodes. This provider is
     *                      available for nodes implementing ChildNodesInterface.
     *
     *  getPathNodes        NOT IMPLEMENTED. Returns a collection of nodes
     *                      referenced by path (path nodes)
     *
     *  getLinkNodes        Returns a collection of nodes referenced by UUID.
     *
     *  getLinkedRootNode   Returns a root node referenced by UUID.
     *
     * If all providers are available:
     *  [
     *    'getParentNode',    // Returns the parent node and is always [0].
     *    'getChildNodes',    // Returns a list of child nodes (if implemented).
     *    'getPathNodes',     // This oubbound node provider is not implemented.
     *    'getLinkNodes',     // Returns a list of hard references to linkable nodes.
     *    'getLinkedRootNode' // Returns a hard reference to a linkable root node.
     *  ]
     *
     * @return array List of out node getter methods
     */
    public function getOutboundProviders(): array;

    /**
    * Get the node's name
    *
    * @return string The node name
    */
    public function getNodeName(): string;

    /**
     * Get the document's phpcr parent
     *
     * @return object The parent document
     */
    public function getParentDocument();

    /**
    * Get the document's identifier (phpcr id)
    *
    * @return string The document id
    */
    public function getDocumentId(): string;

    /**
    * Get the node's parent
    *
    * @return NodeInterface|NULL The parent node
    */
    public function getParentNode(): ?NodeInterface;

    /**
     * Get the node's path
     *
     * @return string The node path
     */
    public function getNodePath(): string;

    /**
     * Get the node's root
     *
     * Walks parent nodes to find the bottom-most root node for a branch.
     *
     * @return RootNodeInterface The root node
     */
    public function getRootNode(): RootNodeInterface;

    /**
     * Get the ledge node
     *
     * A ledge node is a root node that has been inserted into another graph.
     *
     * The bottom-most root node becomes the virtual root node for the resulting
     * connected graph.  All other root nodes become ledge nodes.
     *
     * @return RootNodeInterface The ledge node
     */
    public function getLedgeNode(): RootNodeInterface;

    /**
     * Test if the node is a root node
     *
     * @return bool True if the node is a root node
     */
    public function isRootNode(): bool;

    /**
     * Test if the node is a ledge node
     *
     * @return bool True if the node is a ledge node
     */
    public function isLedgeNode(): bool;

    /**
     * Test if the node is linkable
     *
     * @return bool True if the node is linkable
     */
    public function isLinkableNode(): bool;
}
