<?php

namespace OldApp\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

/**
 * TournamentNode.
 *
 * This is a concrete Document Node.
 *
 * @PHPCR\Document()
 */
class TournamentNode extends AbstractNode implements AllowedByTournamentBag
{
    public function getNodeType()
    {
        return 'Tournament';
    }
}
