<?php

namespace App\Document;

use App\Model\TournamentInterface;
use App\Store\Traits\MatchStoreTrait;
use App\Store\Traits\PlayerStoreTrait;
use App\Store\Traits\TeamStoreTrait;
use App\Store\Traits\TournamentStoreTrait;

/**
 * 'TournamentNode'.
 */
class TournamentNode extends AbstractNode implements TournamentInterface
{
    use MatchStoreTrait, PlayerStoreTrait, TeamStoreTrait, TournamentStoreTrait;

    /**
     * Get the node type (accessor method parameter).
     *
     * @return string
     */
    public function getSemanticNodeType()
    {
        return 'Tournament';
    }
}
