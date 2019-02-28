<?php

namespace App\Document;

use App\Model\LeagueInterface;
use App\Store\Traits\CalendarStoreTrait;
use App\Store\Traits\LeagueStoreTrait;
use App\Store\Traits\PlayerStoreTrait;
use App\Store\Traits\TeamStoreTrait;
use App\Store\Traits\TournamentStoreTrait;

/**
 * LeagueNode.
 */
class LeagueNode extends AbstractNode implements LeagueInterface
{
    use CalendarStoreTrait, LeagueStoreTrait, PlayerStoreTrait, TeamStoreTrait, TournamentStoreTrait;

    /**
     * Get the node type (accessor method parameter).
     *
     * @return string
     */
    public function getSemanticNodeType()
    {
        return 'League';
    }
}
