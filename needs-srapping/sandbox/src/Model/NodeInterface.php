<?php

namespace App\Model;

use App\Exception\PropImmutableException;

/**
 * NodeInterface.
 *
 * Defines behaviour for a class to interact with a graph
 */
interface NodeInterface
{
    /**
     * Get the Node's Nodename.
     *
     * If Nodename is null, getNodename() returns a value generated from Id.
     *
     * If both Nodename and Id are null, getNodeName() returns ''.
     *
     * @return string Best attempt Nodename
     */
    public function getNodename();

    /**
     * Set the Node's Nodename.
     *
     * @throws PropImmutableException If Identifier all ready set
     *
     * @param string
     *
     * @return self
     */
    public function setNodename(string $nodename);

    /**
     * Get the Node's Identifier (Id).
     *
     * If Id is null, getIdentifier() returns a value generated from Nodename
     * and Parent Id. sprintf('%s/%s', Nodename|'', ParentId|'')
     *
     * If all the sibliing properties are null, getId() returns '/'.
     *
     * @return string Best attempt Phpcr Id
     */
    public function getIdentifier();

    /**
     * Set the Node's Identifier (Id).
     *
     * @throws PropImmutableException If parent or nodename is set
     *
     * @return self
     */
    public function setIdentifier(string $identifier);

    /**
     * Get the Parent Node.
     *
     * @return null|ParentNodeInterface
     */
    public function getParent();

    /**
     * Get the Identifier (Id) of the Parent Node.
     *
     * If Parent is null, getParentId() returns a value generated from Id or ''.
     *
     * @return string Parent Node Id or ''
     */
    public function getParentIdentifier();

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
    public function setParent(?ParentNodeInterface $parentNode);

    /**
     * Disconnect the Node from its graph.
     *
     * @return self
     */
    public function disconnectNode();

    /**
     * Move Node to another Parent and/or rename Node.
     *
     * @param null|ParentNodeInterface
     * @param null|string
     *
     * @return self
     */
    public function moveNode(?ParentNodeInterface $newParent = null, ?string $newNodename = null);
}
