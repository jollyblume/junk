<?php

namespace OldApp\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

/**
 * TeamNode.
 *
 * This is a concrete Document Node.
 *
 * @PHPCR\Document()
 */
class TeamNode extends AbstractNode implements AllowedByTeamBag
{
    public function getNodeType()
    {
        return 'Team';
    }
}
