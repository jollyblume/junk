<?php

namespace App\Model;

use App\Store\LocationStoreInterface;
use App\Store\PlayerStoreInterface;
use App\Store\TeamStoreInterface;
use App\Store\TournamentStoreInterface;

interface LocationInterface extends ParentNodeInterface, LocationStoreInterface, PlayerStoreInterface, TeamStoreInterface, TournamentStoreInterface
{
}
