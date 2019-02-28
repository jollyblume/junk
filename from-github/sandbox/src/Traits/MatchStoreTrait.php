<?php

namespace App\Traits;
use App\Model\MatchInterface;
use App\Model\MatchStoreInterface;
use App\Document\MatchBag;

trait MatchStoreTrait {
    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return MatchStoreInterface
     */
    abstract protected function getMatchBagFromStore();

    abstract protected function setMatchBagToStore(MatchStoreInterface $bag);

    private function getOrCreateMatchBag() {
        $bag = $this->getMatchBagFromStore();
        if (null === $bag) {
            $newBag = new MatchBag();
            $newBag->setNodename($newBag->getSemanticNodeType());
            $this->setMatchNodes($newBag);
            $bag = $this->getMatchBagFromStore();
        }
        return $bag;
    }

    public function getMatchNodes() {
        return $this->getOrCreateMatchBag();
    }

    public function setMatchNodes(MatchStoreInterface $bag) {
        $this->setMatchBagToStore($bag);
        return $this;
    }

    public function addMatchNode(MatchInterface $node) {
        $bag = $this->getOrCreateMatchBag();
        return $bag->addMatchNode($node);
    }

    public function hasMatchNode(MatchInterface $node) {
        $bag = $this->getOrCreateMatchBag();
        return $bag->hasMatchNode($node);
    }

    public function hasMatchName(string $nodename) {
        $bag = $this->getOrCreateMatchBag();
        return $bag->hasMatchName($nodename);
    }

    public function removeMatchNode(MatchInterface $node) {
        $bag = $this->getOrCreateMatchBag();
        return $bag->removeMatchNode($node);
    }

    public function removeMatchName(string $nodename) {
        $bag = $this->getOrCreateMatchBag();
        return $bag->removeMatchName($nodename);
    }

    public function getMatchNode(string $nodename) {
        $bag = $this->getOrCreateMatchBag();
        return $bag->getMatchNode($nodename);
    }

    public function setMatchNode(string $nodename, MatchInterface $node) {
        $bag = $this->getOrCreateMatchBag();
        return $bag->setMatchNode($nodename, $node);
    }
}
