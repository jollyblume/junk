<?php

namespace App\Store;

use App\Model\LeagueInterface;

/**
 * LeagueStoreInterface.
 *
 * Defines a StoreInterface for a LeagueInterface Collection that can be
 * embedded into a ParentNodeInterface.
 */
interface LeagueStoreInterface extends StoreInterface
{
    /**
     * Add a League Node.
     *
     * @param LeagueInterface
     *
     * @return self
     */
    public function addLeagueNode(LeagueInterface $node);

    /**
     * Test if there is a League Node.
     *
     * @param LeagueInterface
     *
     * @return bool
     */
    public function hasLeagueNode(LeagueInterface $node);

    /**
     * Test if there is a League Nodename.
     *
     * @param string
     *
     * @return bool
     */
    public function hasLeagueName(string $node);

    /**
     * Add a League Node.
     *
     * @param LeagueInterface
     *
     * @return self
     */
    public function removeLeagueNode(LeagueInterface $node);

    /**
     * Remove a League Nodename.
     *
     * @param string
     *
     * @return null|LeagueInterface Removed node or null if not found
     */
    public function removeLeagueName(string $nodename);

    /**
     * Get a League Nodename.
     *
     * @param string
     *
     * @return null|LeagueInterface Requested node or null if not found
     */
    public function getLeagueNode(string $nodename);

    /**
     * Set a League Nodename and Node.
     *
     * @param string
     * @param LeagueInterface
     *
     * @return self
     */
    public function setLeagueNode(string $nodename, LeagueInterface $node);
}
