<?php

namespace App\Document;

use App\Model\CalendarInterface;

/**
 * CalendarNode.
 */
class CalendarNode extends AbstractNode implements CalendarInterface
{
    /**
     * Get the node type (accessor method parameter).
     *
     * @return string
     */
    public function getSemanticNodeType()
    {
        return 'Calendar';
    }
}
