<?php

namespace App\Document;

use App\Model\LocationInterface;
use App\Store\Traits\LeagueStoreTrait;
use App\Store\Traits\LocationStoreTrait;
use App\Store\Traits\PlayerStoreTrait;
use App\Store\Traits\TeamStoreTrait;
use App\Store\Traits\TournamentStoreTrait;

/**
 * LocationNode.
 */
class LocationNode extends AbstractNode implements LocationInterface
{
    use LeagueStoreTrait, LocationStoreTrait, PlayerStoreTrait, TeamStoreTrait, TournamentStoreTrait;

    /**
     * Get the node type (accessor method parameter).
     *
     * @return string
     */
    public function getSemanticNodeType()
    {
        return 'Location';
    }
}
