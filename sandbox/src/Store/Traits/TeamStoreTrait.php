<?php

namespace App\Store\Traits;

use App\Model\TeamInterface;
use App\Store\TeamStoreInterface;
use App\Document\TeamBag;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TeamStoreTrait.
 *
 * Implements TeamStoreInterface
 */
trait TeamStoreTrait
{
    /**
     * @var TeamStoreInterface
     */
    private $teamBag;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return TeamStoreInterface
     */
    private function getTeamBagFromStore()
    {
        $bag = $this->teamBag;

        return $bag;
    }

    /**
     * Low-level setter implemented by persistence layer.
     *
     * @param TeamStoreInterface
     *
     * @return self
     */
    private function setTeamBagToStore(TeamStoreInterface $bag)
    {
        $bag = $this->addChildIfMissing($bag);
        $this->teamBag = $bag;

        return $this;
    }

    /**
     * Get (or create, if needed) a TeamBag.
     *
     * @return TeamBag
     */
    private function getOrCreateTeamBag()
    {
        $bag = $this->getTeamBagFromStore();
        if (null === $bag) {
            $newBag = new TeamBag();
            $nodename = strtolower($newBag->getSemanticNodeType());
            $newBag->setNodename($nodename);
            $this->setTeamNodes($newBag);
            $bag = $this->getTeamBagFromStore();
        }

        return $bag;
    }

    /**
     * Get all Team Nodes.
     *
     * @return ArrayCollection
     */
    public function getTeamNodes()
    {
        return $this->getOrCreateTeamBag();
    }

    /**
     * Set all Team Nodes.
     *
     * @param TeamStoreInterface
     *
     * @return self
     */
    public function setTeamNodes(TeamStoreInterface $bag)
    {
        $this->setTeamBagToStore($bag);

        return $this;
    }

    /**
     * Add a Team Node.
     *
     * @param TeamInterface
     *
     * @return self
     */
    public function addTeamNode(TeamInterface $node)
    {
        $bag = $this->getOrCreateTeamBag();

        return $bag->addTeamNode($node);
    }

    /**
     * Test if a Team Node exists.
     *
     * @param TeamInterface
     *
     * @return bool
     */
    public function hasTeamNode(TeamInterface $node)
    {
        $bag = $this->getOrCreateTeamBag();

        return $bag->hasTeamNode($node);
    }

    /**
     * Test if a Team Nodename exists.
     *
     * @param string
     *
     * @return bool
     */
    public function hasTeamName(string $nodename)
    {
        $bag = $this->getOrCreateTeamBag();

        return $bag->hasTeamName($nodename);
    }

    /**
     * Remove a Team Node.
     *
     * @param TeamInterface
     *
     * @return null|TeamInterface The removed node or null if not exists
     */
    public function removeTeamNode(TeamInterface $node)
    {
        $bag = $this->getOrCreateTeamBag();

        return $bag->removeTeamNode($node);
    }

    /**
     * Remove a Team Nodename.
     *
     * @param string
     *
     * @return null|TeamInterface The removed node or null if not exists
     */
    public function removeTeamName(string $nodename)
    {
        $bag = $this->getOrCreateTeamBag();

        return $bag->removeTeamName($nodename);
    }

    /**
     * Get a Team Nodename.
     *
     * @param string
     *
     * @return null|TeamInterface The requested node or null if not exists
     */
    public function getTeamNode(string $nodename)
    {
        $bag = $this->getOrCreateTeamBag();

        return $bag->getTeamNode($nodename);
    }

    /**
     * Set a Team Nodename and Node.
     *
     * @param string
     * @param TeamInterface
     *
     * @return null|TeamInterface The requested node or null if not exists
     */
    public function setTeamNode(string $nodename, TeamInterface $node)
    {
        $bag = $this->getOrCreateTeamBag();

        return $bag->setTeamNode($nodename, $node);
    }
}
