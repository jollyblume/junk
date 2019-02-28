<?php

namespace App\ReferenceCollection;

use App\Model\NodeInterface;
use App\ReferrerCollection\ReferrersInterface;
use App\Exception\OutOfScopeException;

interface ReferencesInterface extends NodeInterface {
    /**
     * Get the node type (ie: Email, Player, Team, etc).
     *
     * This is primarily used to type check references and referrers.
     *
     * @return string
     */
    public function getSemanticNodeType();

    /**
     * Get a list of nodeTypes this node can reference
     *
     * @return array [nodeType]
     */
    public function getAllowedReferences();

    /**
     * Get a possibly constrained list of references to other nodes.
     *
     * @param array
     *
     * @return array [nodeType]
     */
    public function getReferences(array $nodeTypes = []);

    /**
     * Add a reference to another node
     *
     * @param ReferrersInterface
     *
     * @throws OutOfScopeException
     *
     * @return self
     */
    public function addReference(ReferrersInterface $node);

    /**
    * Remove a reference to another node.
    *
    * @param ReferrersInterface
    *
    * @throws OutOfScopeException
    *
    * @return self
    */
    public function removeReference(ReferrersInterface $node);

    /**
     * Test if a reference to another node exists.
     *
     * @param ReferrersInterface
     *
     * @return bool
     */
    public function hasReference(ReferrersInterface $node);
}
