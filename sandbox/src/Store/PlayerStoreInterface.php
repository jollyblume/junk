<?php

namespace App\Store;

use App\Model\PlayerInterface;

/**
 * PlayerStoreInterface.
 *
 * Defines a StoreInterface for a PlayerInterface Collection that can be
 * embedded into a ParentNodeInterface.
 */
interface PlayerStoreInterface extends StoreInterface
{
    /**
     * Add a Player Node.
     *
     * @param PlayerInterface
     *
     * @return self
     */
    public function addPlayerNode(PlayerInterface $node);

    /**
     * Test if there is a Player Node.
     *
     * @param PlayerInterface
     *
     * @return bool
     */
    public function hasPlayerNode(PlayerInterface $node);

    /**
     * Test if there is a Player Nodename.
     *
     * @param string
     *
     * @return bool
     */
    public function hasPlayerName(string $node);

    /**
     * Add a Player Node.
     *
     * @param PlayerInterface
     *
     * @return self
     */
    public function removePlayerNode(PlayerInterface $node);

    /**
     * Remove a Player Nodename.
     *
     * @param string
     *
     * @return null|PlayerInterface Removed node or null if not found
     */
    public function removePlayerName(string $nodename);

    /**
     * Get a Player Nodename.
     *
     * @param string
     *
     * @return null|PlayerInterface Requested node or null if not found
     */
    public function getPlayerNode(string $nodename);

    /**
     * Set a Player Nodename and Node.
     *
     * @param string
     * @param PlayerInterface
     *
     * @return self
     */
    public function setPlayerNode(string $nodename, PlayerInterface $node);
}
