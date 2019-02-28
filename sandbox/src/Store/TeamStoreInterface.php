<?php

namespace App\Store;

use App\Model\TeamInterface;

/**
 * TeamStoreInterface.
 *
 * Defines a StoreInterface for a TeamInterface Collection that can be
 * embedded into a ParentNodeInterface.
 */
interface TeamStoreInterface extends StoreInterface
{
    /**
     * Add a Team Node.
     *
     * @param TeamInterface
     *
     * @return self
     */
    public function addTeamNode(TeamInterface $node);

    /**
     * Test if there is a Team Node.
     *
     * @param TeamInterface
     *
     * @return bool
     */
    public function hasTeamNode(TeamInterface $node);

    /**
     * Test if there is a Team Nodename.
     *
     * @param string
     *
     * @return bool
     */
    public function hasTeamName(string $node);

    /**
     * Add a Team Node.
     *
     * @param TeamInterface
     *
     * @return self
     */
    public function removeTeamNode(TeamInterface $node);

    /**
     * Remove a Team Nodename.
     *
     * @param string
     *
     * @return null|TeamInterface Removed node or null if not found
     */
    public function removeTeamName(string $nodename);

    /**
     * Get a Team Nodename.
     *
     * @param string
     *
     * @return null|TeamInterface Requested node or null if not found
     */
    public function getTeamNode(string $nodename);

    /**
     * Set a Team Nodename and Node.
     *
     * @param string
     * @param TeamInterface
     *
     * @return self
     */
    public function setTeamNode(string $nodename, TeamInterface $node);
}
