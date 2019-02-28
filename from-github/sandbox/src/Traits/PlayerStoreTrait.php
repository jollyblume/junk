<?php

namespace App\Traits;
use App\Model\PlayerInterface;
use App\Model\PlayerStoreInterface;
use App\Document\PlayerBag;

trait PlayerStoreTrait {
    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return PlayerStoreInterface
     */
    abstract protected function getPlayerBagFromStore();

    abstract protected function setPlayerBagToStore(PlayerStoreInterface $bag);

    private function getOrCreatePlayerBag() {
        $bag = $this->getPlayerBagFromStore();
        if (null === $bag) {
            $newBag = new PlayerBag();
            $newBag->setNodename($newBag->getSemanticNodeType());
            $this->setPlayerNodes($newBag);
            $bag = $this->getPlayerBagFromStore();
        }
        return $bag;
    }

    public function getPlayerNodes() {
        return $this->getOrCreatePlayerBag();
    }

    public function setPlayerNodes(PlayerStoreInterface $bag) {
        $this->setPlayerBagToStore($bag);
        return $this;
    }

    public function addPlayerNode(PlayerInterface $node) {
        $bag = $this->getOrCreatePlayerBag();
        return $bag->addPlayerNode($node);
    }

    public function hasPlayerNode(PlayerInterface $node) {
        $bag = $this->getOrCreatePlayerBag();
        return $bag->hasPlayerNode($node);
    }

    public function hasPlayerName(string $nodename) {
        $bag = $this->getOrCreatePlayerBag();
        return $bag->hasPlayerName($nodename);
    }

    public function removePlayerNode(PlayerInterface $node) {
        $bag = $this->getOrCreatePlayerBag();
        return $bag->removePlayerNode($node);
    }

    public function removePlayerName(string $nodename) {
        $bag = $this->getOrCreatePlayerBag();
        return $bag->removePlayerName($nodename);
    }

    public function getPlayerNode(string $nodename) {
        $bag = $this->getOrCreatePlayerBag();
        return $bag->getPlayerNode($nodename);
    }

    public function setPlayerNode(string $nodename, PlayerInterface $node) {
        $bag = $this->getOrCreatePlayerBag();
        return $bag->setPlayerNode($nodename, $node);
    }
}
