<?php

namespace App\Document;

use App\Model\EmailInterface;
use App\Reference\Traits\PlayerReferenceTrait;

/**
 * EmailNode.
 *
 * Represents a single email address
 */
class EmailNode extends AbstractNode implements EmailInterface
{
    /**
     * Get the node type (accessor method parameter).
     *
     * @return string
     */
    public function getSemanticNodeType()
    {
        return 'Email';
    }
}
