<?php

namespace App\Traits;
use App\Model\LocationInterface;
use App\Model\LocationStoreInterface;
use App\Document\LocationBag;

trait LocationStoreTrait {
    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return LocationStoreInterface
     */
    abstract protected function getLocationBagFromStore();

    abstract protected function setLocationBagToStore(LocationStoreInterface $bag);

    private function getOrCreateLocationBag() {
        $bag = $this->getLocationBagFromStore();
        if (null === $bag) {
            $newBag = new LocationBag();
            $newBag->setNodename($newBag->getSemanticNodeType());
            $this->setLocationNodes($newBag);
            $bag = $this->getLocationBagFromStore();
        }
        return $bag;
    }

    public function getLocationNodes() {
        return $this->getOrCreateLocationBag();
    }

    public function setLocationNodes(LocationStoreInterface $bag) {
        $this->setLocationBagToStore($bag);
        return $this;
    }

    public function addLocationNode(LocationInterface $node) {
        $bag = $this->getOrCreateLocationBag();
        return $bag->addLocationNode($node);
    }

    public function hasLocationNode(LocationInterface $node) {
        $bag = $this->getOrCreateLocationBag();
        return $bag->hasLocationNode($node);
    }

    public function hasLocationName(string $nodename) {
        $bag = $this->getOrCreateLocationBag();
        return $bag->hasLocationName($nodename);
    }

    public function removeLocationNode(LocationInterface $node) {
        $bag = $this->getOrCreateLocationBag();
        return $bag->removeLocationNode($node);
    }

    public function removeLocationName(string $nodename) {
        $bag = $this->getOrCreateLocationBag();
        return $bag->removeLocationName($nodename);
    }

    public function getLocationNode(string $nodename) {
        $bag = $this->getOrCreateLocationBag();
        return $bag->getLocationNode($nodename);
    }

    public function setLocationNode(string $nodename, LocationInterface $node) {
        $bag = $this->getOrCreateLocationBag();
        return $bag->setLocationNode($nodename, $node);
    }
}
