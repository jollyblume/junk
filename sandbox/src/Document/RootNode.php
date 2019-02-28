<?php

namespace App\Document;

use App\Store\Traits\CalendarStoreTrait;
use App\Store\Traits\EmailStoreTrait;
use App\Store\Traits\LeagueStoreTrait;
use App\Store\Traits\LocationStoreTrait;
use App\Store\Traits\PlayerStoreTrait;
use App\Store\Traits\TeamStoreTrait;
use App\Store\Traits\TournamentStoreTrait;
use App\Model\RootNodeInterface;

/**
 * RootNode.
 */
class RootNode extends AbstractNode implements RootNodeInterface
{
    use CalendarStoreTrait, EmailStoreTrait, LeagueStoreTrait, LocationStoreTrait, PlayerStoreTrait, TeamStoreTrait, TournamentStoreTrait;
}
