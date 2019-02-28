<?php

namespace App\Document;

use App\Model\PlayerInterface;
use App\Store\Traits\TournamentStoreTrait;

/**
 * PlayerNode.
 */
class PlayerNode extends AbstractNode implements PlayerInterface
{
    use TournamentStoreTrait;

    /**
     * Get the node type (accessor method parameter).
     *
     * @return string
     */
    public function getSemanticNodeType()
    {
        return 'Player';
    }
}
