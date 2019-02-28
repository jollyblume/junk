<?php

namespace App\Store\Traits;

use App\Model\TournamentInterface;
use App\Store\TournamentStoreInterface;
use App\Document\TournamentBag;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TournamentStoreTrait.
 *
 * Implements TournamentStoreInterface
 */
trait TournamentStoreTrait
{
    /**
     * @var TournamentStoreInterface
     */
    private $tournamentBag;

    /**
     * Low-level getter.
     *
     * @return TournamentStoreInterface
     */
    private function getTournamentBagFromStore()
    {
        $bag = $this->tournamentBag;

        return $bag;
    }

    /**
     * Low-level setter.
     *
     * @param TournamentStoreInterface
     *
     * @return self
     */
    private function setTournamentBagToStore(TournamentStoreInterface $bag)
    {
        $bag = $this->addChildIfMissing($bag);
        $this->tournamentBag = $bag;

        return $this;
    }

    /**
     * Get (or create, if needed) a TournamentBag.
     *
     * @return TournamentBag
     */
    private function getOrCreateTournamentBag()
    {
        $bag = $this->getTournamentBagFromStore();
        if (null === $bag) {
            $newBag = new TournamentBag();
            $nodename = strtolower($newBag->getSemanticNodeType());
            $newBag->setNodename($nodename);
            $this->setTournamentNodes($newBag);
            $bag = $this->getTournamentBagFromStore();
        }

        return $bag;
    }

    /**
     * Get all Tournament Nodes.
     *
     * @return ArrayCollection
     */
    public function getTournamentNodes()
    {
        return $this->getOrCreateTournamentBag();
    }

    /**
     * Set all Tournament Nodes.
     *
     * @param TournamentStoreInterface
     *
     * @return self
     */
    public function setTournamentNodes(TournamentStoreInterface $bag)
    {
        $this->setTournamentBagToStore($bag);

        return $this;
    }

    /**
     * Add a Tournament Node.
     *
     * @param TournamentInterface
     *
     * @return self
     */
    public function addTournamentNode(TournamentInterface $node)
    {
        $bag = $this->getOrCreateTournamentBag();

        return $bag->addTournamentNode($node);
    }

    /**
     * Test if a Tournament Node exists.
     *
     * @param TournamentInterface
     *
     * @return bool
     */
    public function hasTournamentNode(TournamentInterface $node)
    {
        $bag = $this->getOrCreateTournamentBag();

        return $bag->hasTournamentNode($node);
    }

    /**
     * Test if a Tournament Nodename exists.
     *
     * @param string
     *
     * @return bool
     */
    public function hasTournamentName(string $nodename)
    {
        $bag = $this->getOrCreateTournamentBag();

        return $bag->hasTournamentName($nodename);
    }

    /**
     * Remove a Tournament Node.
     *
     * @param TournamentInterface
     *
     * @return null|TournamentInterface The removed node or null if not exists
     */
    public function removeTournamentNode(TournamentInterface $node)
    {
        $bag = $this->getOrCreateTournamentBag();

        return $bag->removeTournamentNode($node);
    }

    /**
     * Remove a Tournament Nodename.
     *
     * @param string
     *
     * @return null|TournamentInterface The removed node or null if not exists
     */
    public function removeTournamentName(string $nodename)
    {
        $bag = $this->getOrCreateTournamentBag();

        return $bag->removeTournamentName($nodename);
    }

    /**
     * Get a Tournament Nodename.
     *
     * @param string
     *
     * @return null|TournamentInterface The requested node or null if not exists
     */
    public function getTournamentNode(string $nodename)
    {
        $bag = $this->getOrCreateTournamentBag();

        return $bag->getTournamentNode($nodename);
    }

    /**
     * Set a Tournament Nodename and Node.
     *
     * @param string
     * @param TournamentInterface
     *
     * @return null|TournamentInterface The requested node or null if not exists
     */
    public function setTournamentNode(string $nodename, TournamentInterface $node)
    {
        $bag = $this->getOrCreateTournamentBag();

        return $bag->setTournamentNode($nodename, $node);
    }
}
