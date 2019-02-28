<?php

namespace App\Model;
use App\Model\StoreInterface;

interface PlayerStoreInterface extends StoreInterface {
    public function addPlayerNode(PlayerInterface $node);

    public function hasPlayerNode(PlayerInterface $node);

    public function hasPlayerName(string $nodename);

    public function removePlayerNode(PlayerInterface $node);

    public function removePlayerName(string $nodename);

    public function getPlayerNode(string $nodename);

    public function setPlayerNode(string $nodename, PlayerInterface $node);
}
