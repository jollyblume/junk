<?php

namespace App\Store\Traits;

use App\Model\MatchInterface;
use App\Store\MatchStoreInterface;
use App\Document\MatchBag;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * MatchStoreTrait.
 *
 * Implements MatchStoreInterface
 */
trait MatchStoreTrait
{
    /**
     * @var MatchStoreInterface
     */
    private $matchBag;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return MatchStoreInterface
     */
    private function getMatchBagFromStore()
    {
        $bag = $this->matchBag;

        return $bag;
    }

    /**
     * Low-level setter implemented by persistence layer.
     *
     * @param MatchStoreInterface
     *
     * @return self
     */
    private function setMatchBagToStore(MatchStoreInterface $bag)
    {
        $bag = $this->addChildIfMissing($bag);
        $this->matchBag = $bag;

        return $this;
    }

    /**
     * Get (or create, if needed) a MatchBag.
     *
     * @return MatchBag
     */
    private function getOrCreateMatchBag()
    {
        $bag = $this->getMatchBagFromStore();
        if (null === $bag) {
            $newBag = new MatchBag();
            $nodename = strtolower($newBag->getSemanticNodeType());
            $newBag->setNodename($nodename);
            $this->setMatchNodes($newBag);
            $bag = $this->getMatchBagFromStore();
        }

        return $bag;
    }

    /**
     * Get all Match Nodes.
     *
     * @return ArrayCollection
     */
    public function getMatchNodes()
    {
        return $this->getOrCreateMatchBag();
    }

    /**
     * Set all Match Nodes.
     *
     * @param MatchStoreInterface
     *
     * @return self
     */
    public function setMatchNodes(MatchStoreInterface $bag)
    {
        $this->setMatchBagToStore($bag);

        return $this;
    }

    /**
     * Add a Match Node.
     *
     * @param MatchInterface
     *
     * @return self
     */
    public function addMatchNode(MatchInterface $node)
    {
        $bag = $this->getOrCreateMatchBag();

        return $bag->addMatchNode($node);
    }

    /**
     * Test if a Match Node exists.
     *
     * @param MatchInterface
     *
     * @return bool
     */
    public function hasMatchNode(MatchInterface $node)
    {
        $bag = $this->getOrCreateMatchBag();

        return $bag->hasMatchNode($node);
    }

    /**
     * Test if a Match Nodename exists.
     *
     * @param string
     *
     * @return bool
     */
    public function hasMatchName(string $nodename)
    {
        $bag = $this->getOrCreateMatchBag();

        return $bag->hasMatchName($nodename);
    }

    /**
     * Remove a Match Node.
     *
     * @param MatchInterface
     *
     * @return null|MatchInterface The removed node or null if not exists
     */
    public function removeMatchNode(MatchInterface $node)
    {
        $bag = $this->getOrCreateMatchBag();

        return $bag->removeMatchNode($node);
    }

    /**
     * Remove a Match Nodename.
     *
     * @param string
     *
     * @return null|MatchInterface The removed node or null if not exists
     */
    public function removeMatchName(string $nodename)
    {
        $bag = $this->getOrCreateMatchBag();

        return $bag->removeMatchName($nodename);
    }

    /**
     * Get a Match Nodename.
     *
     * @param string
     *
     * @return null|MatchInterface The requested node or null if not exists
     */
    public function getMatchNode(string $nodename)
    {
        $bag = $this->getOrCreateMatchBag();

        return $bag->getMatchNode($nodename);
    }

    /**
     * Set a Match Nodename and Node.
     *
     * @param string
     * @param MatchInterface
     *
     * @return null|MatchInterface The requested node or null if not exists
     */
    public function setMatchNode(string $nodename, MatchInterface $node)
    {
        $bag = $this->getOrCreateMatchBag();

        return $bag->setMatchNode($nodename, $node);
    }
}
