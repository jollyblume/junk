<?php

namespace App\Store\Traits;

use App\Model\LeagueInterface;
use App\Store\LeagueStoreInterface;
use App\Document\LeagueBag;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * LeagueStoreTrait.
 *
 * Implements LeagueStoreInterface
 */
trait LeagueStoreTrait
{
    /**
     * @var LeagueStoreInterface
     */
    private $leagueBag;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return LeagueStoreInterface
     */
    private function getLeagueBagFromStore()
    {
        $bag = $this->leagueBag;

        return $bag;
    }

    /**
     * Low-level setter implemented by persistence layer.
     *
     * @param LeagueStoreInterface
     *
     * @return self
     */
    private function setLeagueBagToStore(LeagueStoreInterface $bag)
    {
        $bag = $this->addChildIfMissing($bag);
        $this->leagueBag = $bag;

        return $this;
    }

    /**
     * Get (or create, if needed) a LeagueBag.
     *
     * @return LeagueBag
     */
    private function getOrCreateLeagueBag()
    {
        $bag = $this->getLeagueBagFromStore();
        if (null === $bag) {
            $newBag = new LeagueBag();
            $nodename = strtolower($newBag->getSemanticNodeType());
            $newBag->setNodename($nodename);
            $this->setLeagueNodes($newBag);
            $bag = $this->getLeagueBagFromStore();
        }

        return $bag;
    }

    /**
     * Get all League Nodes.
     *
     * @return ArrayCollection
     */
    public function getLeagueNodes()
    {
        return $this->getOrCreateLeagueBag();
    }

    /**
     * Set all League Nodes.
     *
     * @param LeagueStoreInterface
     *
     * @return self
     */
    public function setLeagueNodes(LeagueStoreInterface $bag)
    {
        $this->setLeagueBagToStore($bag);

        return $this;
    }

    /**
     * Add a League Node.
     *
     * @param LeagueInterface
     *
     * @return self
     */
    public function addLeagueNode(LeagueInterface $node)
    {
        $bag = $this->getOrCreateLeagueBag();

        return $bag->addLeagueNode($node);
    }

    /**
     * Test if a League Node exists.
     *
     * @param LeagueInterface
     *
     * @return bool
     */
    public function hasLeagueNode(LeagueInterface $node)
    {
        $bag = $this->getOrCreateLeagueBag();

        return $bag->hasLeagueNode($node);
    }

    /**
     * Test if a League Nodename exists.
     *
     * @param string
     *
     * @return bool
     */
    public function hasLeagueName(string $nodename)
    {
        $bag = $this->getOrCreateLeagueBag();

        return $bag->hasLeagueName($nodename);
    }

    /**
     * Remove a League Node.
     *
     * @param LeagueInterface
     *
     * @return null|LeagueInterface The removed node or null if not exists
     */
    public function removeLeagueNode(LeagueInterface $node)
    {
        $bag = $this->getOrCreateLeagueBag();

        return $bag->removeLeagueNode($node);
    }

    /**
     * Remove a League Nodename.
     *
     * @param string
     *
     * @return null|LeagueInterface The removed node or null if not exists
     */
    public function removeLeagueName(string $nodename)
    {
        $bag = $this->getOrCreateLeagueBag();

        return $bag->removeLeagueName($nodename);
    }

    /**
     * Get a League Nodename.
     *
     * @param string
     *
     * @return null|LeagueInterface The requested node or null if not exists
     */
    public function getLeagueNode(string $nodename)
    {
        $bag = $this->getOrCreateLeagueBag();

        return $bag->getLeagueNode($nodename);
    }

    /**
     * Set a League Nodename and Node.
     *
     * @param string
     * @param LeagueInterface
     *
     * @return null|LeagueInterface The requested node or null if not exists
     */
    public function setLeagueNode(string $nodename, LeagueInterface $node)
    {
        $bag = $this->getOrCreateLeagueBag();

        return $bag->setLeagueNode($nodename, $node);
    }
}
