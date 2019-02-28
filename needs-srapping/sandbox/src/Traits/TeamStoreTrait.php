<?php

namespace App\Traits;
use App\Model\TeamInterface;
use App\Model\TeamStoreInterface;
use App\Document\TeamBag;

trait TeamStoreTrait {
    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return TeamStoreInterface
     */
    abstract protected function getTeamBagFromStore();

    abstract protected function setTeamBagToStore(TeamStoreInterface $bag);

    private function getOrCreateTeamBag() {
        $bag = $this->getTeamBagFromStore();
        if (null === $bag) {
            $newBag = new TeamBag();
            $newBag->setNodename($newBag->getSemanticNodeType());
            $this->setTeamNodes($newBag);
            $bag = $this->getTeamBagFromStore();
        }
        return $bag;
    }

    public function getTeamNodes() {
        return $this->getOrCreateTeamBag();
    }

    public function setTeamNodes(TeamStoreInterface $bag) {
        $this->setTeamBagToStore($bag);
        return $this;
    }

    public function addTeamNode(TeamInterface $node) {
        $bag = $this->getOrCreateTeamBag();
        return $bag->addTeamNode($node);
    }

    public function hasTeamNode(TeamInterface $node) {
        $bag = $this->getOrCreateTeamBag();
        return $bag->hasTeamNode($node);
    }

    public function hasTeamName(string $nodename) {
        $bag = $this->getOrCreateTeamBag();
        return $bag->hasTeamName($nodename);
    }

    public function removeTeamNode(TeamInterface $node) {
        $bag = $this->getOrCreateTeamBag();
        return $bag->removeTeamNode($node);
    }

    public function removeTeamName(string $nodename) {
        $bag = $this->getOrCreateTeamBag();
        return $bag->removeTeamName($nodename);
    }

    public function getTeamNode(string $nodename) {
        $bag = $this->getOrCreateTeamBag();
        return $bag->getTeamNode($nodename);
    }

    public function setTeamNode(string $nodename, TeamInterface $node) {
        $bag = $this->getOrCreateTeamBag();
        return $bag->setTeamNode($nodename, $node);
    }
}
