<?php

namespace App\Store\Traits;

use App\Model\LocationInterface;
use App\Store\LocationStoreInterface;
use App\Document\LocationBag;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * LocationStoreTrait.
 *
 * Implements LocationStoreInterface
 */
trait LocationStoreTrait
{
    /**
     * @var LocationStoreInterface
     */
    private $locationBag;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return LocationStoreInterface
     */
    private function getLocationBagFromStore()
    {
        $bag = $this->locationBag;

        return $bag;
    }

    /**
     * Low-level setter implemented by persistence layer.
     *
     * @param LocationStoreInterface
     *
     * @return self
     */
    private function setLocationBagToStore(LocationStoreInterface $bag)
    {
        $bag = $this->addChildIfMissing($bag);
        $this->locationBag = $bag;

        return $this;
    }

    /**
     * Get (or create, if needed) a LocationBag.
     *
     * @return LocationBag
     */
    private function getOrCreateLocationBag()
    {
        $bag = $this->getLocationBagFromStore();
        if (null === $bag) {
            $newBag = new LocationBag();
            $nodename = strtolower($newBag->getSemanticNodeType());
            $newBag->setNodename($nodename);
            $this->setLocationNodes($newBag);
            $bag = $this->getLocationBagFromStore();
        }

        return $bag;
    }

    /**
     * Get all Location Nodes.
     *
     * @return ArrayCollection
     */
    public function getLocationNodes()
    {
        return $this->getOrCreateLocationBag();
    }

    /**
     * Set all Location Nodes.
     *
     * @param LocationStoreInterface
     *
     * @return self
     */
    public function setLocationNodes(LocationStoreInterface $bag)
    {
        $this->setLocationBagToStore($bag);

        return $this;
    }

    /**
     * Add a Location Node.
     *
     * @param LocationInterface
     *
     * @return self
     */
    public function addLocationNode(LocationInterface $node)
    {
        $bag = $this->getOrCreateLocationBag();

        return $bag->addLocationNode($node);
    }

    /**
     * Test if a Location Node exists.
     *
     * @param LocationInterface
     *
     * @return bool
     */
    public function hasLocationNode(LocationInterface $node)
    {
        $bag = $this->getOrCreateLocationBag();

        return $bag->hasLocationNode($node);
    }

    /**
     * Test if a Location Nodename exists.
     *
     * @param string
     *
     * @return bool
     */
    public function hasLocationName(string $nodename)
    {
        $bag = $this->getOrCreateLocationBag();

        return $bag->hasLocationName($nodename);
    }

    /**
     * Remove a Location Node.
     *
     * @param LocationInterface
     *
     * @return null|LocationInterface The removed node or null if not exists
     */
    public function removeLocationNode(LocationInterface $node)
    {
        $bag = $this->getOrCreateLocationBag();

        return $bag->removeLocationNode($node);
    }

    /**
     * Remove a Location Nodename.
     *
     * @param string
     *
     * @return null|LocationInterface The removed node or null if not exists
     */
    public function removeLocationName(string $nodename)
    {
        $bag = $this->getOrCreateLocationBag();

        return $bag->removeLocationName($nodename);
    }

    /**
     * Get a Location Nodename.
     *
     * @param string
     *
     * @return null|LocationInterface The requested node or null if not exists
     */
    public function getLocationNode(string $nodename)
    {
        $bag = $this->getOrCreateLocationBag();

        return $bag->getLocationNode($nodename);
    }

    /**
     * Set a Location Nodename and Node.
     *
     * @param string
     * @param LocationInterface
     *
     * @return null|LocationInterface The requested node or null if not exists
     */
    public function setLocationNode(string $nodename, LocationInterface $node)
    {
        $bag = $this->getOrCreateLocationBag();

        return $bag->setLocationNode($nodename, $node);
    }
}
