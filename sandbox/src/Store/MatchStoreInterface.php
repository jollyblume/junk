<?php

namespace App\Store;

use App\Model\MatchInterface;

/**
 * MatchStoreInterface.
 *
 * Defines a StoreInterface for a MatchInterface Collection that can be
 * embedded into a ParentNodeInterface.
 */
interface MatchStoreInterface extends StoreInterface
{
    /**
     * Add a Match Node.
     *
     * @param MatchInterface
     *
     * @return self
     */
    public function addMatchNode(MatchInterface $node);

    /**
     * Test if there is a Match Node.
     *
     * @param MatchInterface
     *
     * @return bool
     */
    public function hasMatchNode(MatchInterface $node);

    /**
     * Test if there is a Match Nodename.
     *
     * @param string
     *
     * @return bool
     */
    public function hasMatchName(string $node);

    /**
     * Add a Match Node.
     *
     * @param MatchInterface
     *
     * @return self
     */
    public function removeMatchNode(MatchInterface $node);

    /**
     * Remove a Match Nodename.
     *
     * @param string
     *
     * @return null|MatchInterface Removed node or null if not found
     */
    public function removeMatchName(string $nodename);

    /**
     * Get a Match Nodename.
     *
     * @param string
     *
     * @return null|MatchInterface Requested node or null if not found
     */
    public function getMatchNode(string $nodename);

    /**
     * Set a Match Nodename and Node.
     *
     * @param string
     * @param MatchInterface
     *
     * @return self
     */
    public function setMatchNode(string $nodename, MatchInterface $node);
}
