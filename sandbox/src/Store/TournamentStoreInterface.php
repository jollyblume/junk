<?php

namespace App\Store;

use App\Model\TournamentInterface;

/**
 * TournamentStoreInterface.
 *
 * Defines a StoreInterface for a TournamentInterface Collection that can be
 * embedded into a ParentNodeInterface.
 */
interface TournamentStoreInterface extends StoreInterface
{
    /**
     * Add a Tournament Node.
     *
     * @param TournamentInterface
     *
     * @return self
     */
    public function addTournamentNode(TournamentInterface $node);

    /**
     * Test if there is a Tournament Node.
     *
     * @param TournamentInterface
     *
     * @return bool
     */
    public function hasTournamentNode(TournamentInterface $node);

    /**
     * Test if there is a Tournament Nodename.
     *
     * @param string
     *
     * @return bool
     */
    public function hasTournamentName(string $node);

    /**
     * Add a Tournament Node.
     *
     * @param TournamentInterface
     *
     * @return self
     */
    public function removeTournamentNode(TournamentInterface $node);

    /**
     * Remove a Tournament Nodename.
     *
     * @param string
     *
     * @return null|TournamentInterface Removed node or null if not found
     */
    public function removeTournamentName(string $nodename);

    /**
     * Get a Tournament Nodename.
     *
     * @param string
     *
     * @return null|TournamentInterface Requested node or null if not found
     */
    public function getTournamentNode(string $nodename);

    /**
     * Set a Tournament Nodename and Node.
     *
     * @param string
     * @param TournamentInterface
     *
     * @return self
     */
    public function setTournamentNode(string $nodename, TournamentInterface $node);
}
