<?php

namespace App\Collections;

/**
 * NodeTypeInterface.
 */
interface SemanticCollectionInterface
{
    /**
     * Get the semantic Node Type.
     *
     * The Node Type is used to compute the method name of semantic collection
     * accessor methods.
     *
     * @return string The Bag Type
     */
    public function getSemanticNodeType();

    /**
     * Compute semantic method name.
     *
     * Inserts the getSemanticNodeType() into accessors, so the collection
     * accessors methods in a class have a single method that handles each type of accessor.
     *
     * @param string
     *
     * @throws OutOfScopeException
     *
     * @return string Method name requested (ie: addPlayerNode)
     */
    public function getSemanticMethodName(string $templateName);
}
