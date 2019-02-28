<?php

namespace App\Store\Traits;

use App\Model\PlayerInterface;
use App\Store\PlayerStoreInterface;
use App\Document\PlayerBag;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PlayerStoreTrait.
 *
 * Implements PlayerStoreInterface
 */
trait PlayerStoreTrait
{
    /**
     * @var PlayerStoreInterface
     */
    private $playerBag;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return PlayerStoreInterface
     */
    private function getPlayerBagFromStore()
    {
        $bag = $this->playerBag;

        return $bag;
    }

    /**
     * Low-level setter implemented by persistence layer.
     *
     * @param PlayerStoreInterface
     *
     * @return self
     */
    private function setPlayerBagToStore(PlayerStoreInterface $bag)
    {
        $bag = $this->addChildIfMissing($bag);
        $this->playerBag = $bag;

        return $this;
    }

    /**
     * Get (or create, if needed) a PlayerBag.
     *
     * @return PlayerBag
     */
    private function getOrCreatePlayerBag()
    {
        $bag = $this->getPlayerBagFromStore();
        if (null === $bag) {
            $newBag = new PlayerBag();
            $nodename = strtolower($newBag->getSemanticNodeType());
            $newBag->setNodename($nodename);
            $this->setPlayerNodes($newBag);
            $bag = $this->getPlayerBagFromStore();
        }

        return $bag;
    }

    /**
     * Get all Player Nodes.
     *
     * @return ArrayCollection
     */
    public function getPlayerNodes()
    {
        return $this->getOrCreatePlayerBag();
    }

    /**
     * Set all Player Nodes.
     *
     * @param PlayerStoreInterface
     *
     * @return self
     */
    public function setPlayerNodes(PlayerStoreInterface $bag)
    {
        $this->setPlayerBagToStore($bag);

        return $this;
    }

    /**
     * Add a Player Node.
     *
     * @param PlayerInterface
     *
     * @return self
     */
    public function addPlayerNode(PlayerInterface $node)
    {
        $bag = $this->getOrCreatePlayerBag();

        return $bag->addPlayerNode($node);
    }

    /**
     * Test if a Player Node exists.
     *
     * @param PlayerInterface
     *
     * @return bool
     */
    public function hasPlayerNode(PlayerInterface $node)
    {
        $bag = $this->getOrCreatePlayerBag();

        return $bag->hasPlayerNode($node);
    }

    /**
     * Test if a Player Nodename exists.
     *
     * @param string
     *
     * @return bool
     */
    public function hasPlayerName(string $nodename)
    {
        $bag = $this->getOrCreatePlayerBag();

        return $bag->hasPlayerName($nodename);
    }

    /**
     * Remove a Player Node.
     *
     * @param PlayerInterface
     *
     * @return null|PlayerInterface The removed node or null if not exists
     */
    public function removePlayerNode(PlayerInterface $node)
    {
        $bag = $this->getOrCreatePlayerBag();

        return $bag->removePlayerNode($node);
    }

    /**
     * Remove a Player Nodename.
     *
     * @param string
     *
     * @return null|PlayerInterface The removed node or null if not exists
     */
    public function removePlayerName(string $nodename)
    {
        $bag = $this->getOrCreatePlayerBag();

        return $bag->removePlayerName($nodename);
    }

    /**
     * Get a Player Nodename.
     *
     * @param string
     *
     * @return null|PlayerInterface The requested node or null if not exists
     */
    public function getPlayerNode(string $nodename)
    {
        $bag = $this->getOrCreatePlayerBag();

        return $bag->getPlayerNode($nodename);
    }

    /**
     * Set a Player Nodename and Node.
     *
     * @param string
     * @param PlayerInterface
     *
     * @return null|PlayerInterface The requested node or null if not exists
     */
    public function setPlayerNode(string $nodename, PlayerInterface $node)
    {
        $bag = $this->getOrCreatePlayerBag();

        return $bag->setPlayerNode($nodename, $node);
    }
}
