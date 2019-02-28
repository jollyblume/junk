<?php

namespace App\Traits;
use App\Model\TournamentInterface;
use App\Model\TournamentStoreInterface;
use App\Document\TournamentBag;

trait TournamentStoreTrait {
    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return TournamentStoreInterface
     */
    abstract protected function getTournamentBagFromStore();

    abstract protected function setTournamentBagToStore(TournamentStoreInterface $bag);

    private function getOrCreateTournamentBag() {
        $bag = $this->getTournamentBagFromStore();
        if (null === $bag) {
            $bag = new TournamentBag();
            $bag->setNodename($bag->getSemanticNodeType());
            $this->setTournamentNodes($bag);
        }
        return $bag;
    }

    public function getTournamentNodes() {
        return $this->getOrCreateTournamentBag();
    }

    public function setTournamentNodes(TournamentStoreInterface $bag) {
        $this->setTournamentBagToStore($bag);
        return $this;
    }

    public function addTournamentNode(TournamentInterface $node) {
        $bag = $this->getOrCreateTournamentBag();
        return $bag->addTournamentNode($node);
    }

    public function hasTournamentNode(TournamentInterface $node) {
        $bag = $this->getOrCreateTournamentBag();
        return $bag->hasTournamentNode($node);
    }

    public function hasTournamentName(string $nodename) {
        $bag = $this->getOrCreateTournamentBag();
        return $bag->hasTournamentName($nodename);
    }

    public function removeTournamentNode(TournamentInterface $node) {
        $bag = $this->getOrCreateTournamentBag();
        return $bag->removeTournamentNode($node);
    }

    public function removeTournamentName(string $nodename) {
        $bag = $this->getOrCreateTournamentBag();
        return $bag->removeTournamentName($nodename);
    }

    public function getTournamentNode(string $nodename) {
        $bag = $this->getOrCreateTournamentBag();
        return $bag->getTournamentNode($nodename);
    }

    public function setTournamentNode(string $nodename, TournamentInterface $node) {
        $bag = $this->getOrCreateTournamentBag();
        return $bag->setTournamentNode($nodename, $node);
    }
}
