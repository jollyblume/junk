<?php

namespace App;

/**
 * NodeTypeInterface.
 */
interface NodeTypeInterface
{
    /**
     * Get the Node Type.
     *
     * For Bags, this is the same as the Document Node Type is supports
     *
     * Used, for instance, as the Nodename of the Bag when it is use as a Tree
     * Node.
     *
     * @return string The Bag Type
     */
    public function getNodeType();

    /**
     * Compute method name.
     *
     * Inserts the getNodeType() into accessors, so the implementation methods
     * in this class have a single method that handles each type of accessor.
     *
     * @param string
     *
     * @throws OutOfScopeException
     *
     * @return string Method name requested (ie: addPlayerNode)
     */
    public function computeMethodName(string $templateName);
}
