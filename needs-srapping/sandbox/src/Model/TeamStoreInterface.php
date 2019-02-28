<?php

namespace App\Model;
use App\Model\StoreInterface;

interface TeamStoreInterface extends StoreInterface {
    public function addTeamNode(TeamInterface $node);

    public function hasTeamNode(TeamInterface $node);

    public function hasTeamName(string $nodename);

    public function removeTeamNode(TeamInterface $node);

    public function removeTeamName(string $nodename);

    public function getTeamNode(string $nodename);

    public function setTeamNode(string $nodename, TeamInterface $node);
}
