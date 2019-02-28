<?php

namespace App\Model;
use App\Model\StoreInterface;

interface LeagueStoreInterface extends StoreInterface {
    public function addLeagueNode(LeagueInterface $node);

    public function hasLeagueNode(LeagueInterface $node);

    public function hasLeagueName(string $nodename);

    public function removeLeagueNode(LeagueInterface $node);

    public function removeLeagueName(string $nodename);

    public function getLeagueNode(string $nodename);

    public function setLeagueNode(string $nodename, LeagueInterface $node);
}
