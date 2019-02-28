<?php

namespace App\Model;
use App\Model\StoreInterface;
use App\Model\CookieStoreInterface;
use App\Collections\SemanticCollectionInterface;

interface TournamentStoreInterface extends StoreInterface {
    public function addTournamentNode(TournamentInterface $node);

    public function hasTournamentNode(TournamentInterface $node);

    public function hasTournamentName(string $nodename);

    public function removeTournamentNode(TournamentInterface $node);

    public function removeTournamentName(string $nodename);

    public function getTournamentNode(string $nodename);

    public function setTournamentNode(string $nodename, TournamentInterface $node);
}
