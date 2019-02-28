<?php

namespace OldApp\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

/**
 * PlayerNode.
 *
 * This is a concrete Document Node.
 *
 *
 * @PHPCR\Document()
 */
class PlayerNode extends AbstractNode implements AllowedByPlayerBag
{
    public function getNodeType()
    {
        return 'Player';
    }
}
