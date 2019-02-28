<?php

namespace App\Model;
use App\Model\StoreInterface;

interface MatchStoreInterface extends StoreInterface {
    public function addMatchNode(MatchInterface $node);

    public function hasMatchNode(MatchInterface $node);

    public function hasMatchName(string $nodename);

    public function removeMatchNode(MatchInterface $node);

    public function removeMatchName(string $nodename);

    public function getMatchNode(string $nodename);

    public function setMatchNode(string $nodename, MatchInterface $node);
}
