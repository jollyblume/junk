<?php

namespace OldApp\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

/**
 * LeagueNode.
 *
 * This is a concrete Document Node.
 *
 *
 * @PHPCR\Document()
 */
class LeagueNode extends AbstractNode implements AllowedByLeagueBag
{
    public function getNodeType()
    {
        return 'League';
    }
}
