<?php

namespace App\Document;

use App\Model\MatchInterface;

/**
 * MatchNode.
 */
class MatchNode extends AbstractNode implements MatchInterface
{
    /**
     * Get the node type (accessor method parameter).
     *
     * @return string
     */
    public function getSemanticNodeType()
    {
        return 'Match';
    }
}
