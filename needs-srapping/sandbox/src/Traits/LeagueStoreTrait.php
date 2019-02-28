<?php

namespace App\Traits;
use App\Model\LeagueInterface;
use App\Model\LeagueStoreInterface;
use App\Document\LeagueBag;

trait LeagueStoreTrait {
    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return LeagueStoreInterface
     */
    abstract protected function getLeagueBagFromStore();

    abstract protected function setLeagueBagToStore(LeagueStoreInterface $bag);

    private function getOrCreateLeagueBag() {
        $bag = $this->getLeagueBagFromStore();
        if (null === $bag) {
            $newBag = new LeagueBag();
            $newBag->setNodename($newBag->getSemanticNodeType());
            $this->setLeagueNodes($newBag);
            $bag = $this->getLeagueBagFromStore();
        }
        return $bag;
    }

    public function getLeagueNodes() {
        return $this->getOrCreateLeagueBag();
    }

    public function setLeagueNodes(LeagueStoreInterface $bag) {
        $this->setLeagueBagToStore($bag);
        return $this;
    }

    public function addLeagueNode(LeagueInterface $node) {
        $bag = $this->getOrCreateLeagueBag();
        return $bag->addLeagueNode($node);
    }

    public function hasLeagueNode(LeagueInterface $node) {
        $bag = $this->getOrCreateLeagueBag();
        return $bag->hasLeagueNode($node);
    }

    public function hasLeagueName(string $nodename) {
        $bag = $this->getOrCreateLeagueBag();
        return $bag->hasLeagueName($nodename);
    }

    public function removeLeagueNode(LeagueInterface $node) {
        $bag = $this->getOrCreateLeagueBag();
        return $bag->removeLeagueNode($node);
    }

    public function removeLeagueName(string $nodename) {
        $bag = $this->getOrCreateLeagueBag();
        return $bag->removeLeagueName($nodename);
    }

    public function getLeagueNode(string $nodename) {
        $bag = $this->getOrCreateLeagueBag();
        return $bag->getLeagueNode($nodename);
    }

    public function setLeagueNode(string $nodename, LeagueInterface $node) {
        $bag = $this->getOrCreateLeagueBag();
        return $bag->setLeagueNode($nodename, $node);
    }
}
