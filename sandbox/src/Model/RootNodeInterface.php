<?php

namespace App\Model;

use App\Store\StoreInterface;
use App\Store\CalendarStoreInterface;
use App\Store\EmailStoreInterface;
use App\Store\LeagueStoreInterface;
use App\Store\LocationStoreInterface;
use App\Store\PlayerStoreInterface;
use App\Store\TeamStoreInterface;
use App\Store\TournamentStoreInterface;

interface RootNodeInterface extends StoreInterface, CalendarStoreInterface, EmailStoreInterface, LeagueStoreInterface, LocationStoreInterface, PlayerStoreInterface, TeamStoreInterface, TournamentStoreInterface
{
}
