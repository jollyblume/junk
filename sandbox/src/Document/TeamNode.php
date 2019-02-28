<?php

namespace App\Document;

use App\Model\TeamInterface;
use App\Store\Traits\TournamentStoreTrait;

/**
 * TeamNode.
 */
class TeamNode extends AbstractNode implements TeamInterface
{
    use TournamentStoreTrait;

    /**
     * Get the node type (accessor method parameter).
     *
     * @return string
     */
    public function getSemanticNodeType()
    {
        return 'Team';
    }
}
