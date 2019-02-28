<?php

namespace App\ReferrerCollection;

use App\Model\ReferenceableNodeInterface;
use App\ReferenceCollection\ReferencesInterface;

interface ReferrersInterface extends ReferenceableNodeInterface {
    /**
     * Get the node type (ie: Email, Player, Team, etc).
     *
     * This is primarily used to type check references and referrers.
     *
     * @return string
     */
    public function getSemanticNodeType();

    /**
     * Get a list of nodeTypes that can reference this node
     *
     * @return array [nodeType]
     */
    public function getAllowedReferrers();

    /**
     * Get a possibly constrained list of references from other nodes.
     *
     * @param array
     *
     * @return array [nodeType]
     */
    public function getReferrers(array $nodeTypes = []);

    /**
     * Add a reference from another node
     *
     * @param ReferencesInterface
     *
     * @return self
     */
    public function addReferrer(ReferencesInterface $node);

    /**
     * Remove a reference from another node.
     *
     * @param ReferencesInterface
     *
     * @return self
     */
    public function removeReferrer(ReferencesInterface $node);

    /**
     * Test if a reference from another node exists.
     *
     * @param ReferencesInterface
     *
     * @return bool
     */
    public function hasReferrer(ReferencesInterface $node);
}
