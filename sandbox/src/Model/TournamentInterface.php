<?php

namespace App\Model;

use App\Store\MatchStoreInterface;
use App\Store\PlayerStoreInterface;
use App\Store\TeamStoreInterface;
use App\Store\TournamentStoreInterface;

interface TournamentInterface extends ParentNodeInterface, MatchStoreInterface, PlayerStoreInterface, TeamStoreInterface, TournamentStoreInterface
{
}
