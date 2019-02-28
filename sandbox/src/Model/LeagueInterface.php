<?php

namespace App\Model;

use App\Store\CalendarStoreInterface;
use App\Store\LeagueStoreInterface;
use App\Store\PlayerStoreInterface;
use App\Store\TeamStoreInterface;
use App\Store\TournamentStoreInterface;

interface LeagueInterface extends ParentNodeInterface, CalendarStoreInterface, PlayerStoreInterface, TeamStoreInterface, TournamentStoreInterface, LeagueStoreInterface
{
}
