<?php

namespace OldApp\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

/**
 * MatchNode.
 *
 * This is a concrete Document Node.
 *
 *
 * @PHPCR\Document()
 */
class MatchNode extends AbstractNode implements AllowedByMatchBag
{
    public function getNodeType()
    {
        return 'Match';
    }
}
