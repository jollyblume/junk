<?php

namespace OldApp\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

/**
 * LocationNode.
 *
 * This is a concrete Document Node.
 *
 *
 * @PHPCR\Document()
 */
class LocationNode extends AbstractNode implements AllowedByLocationBag
{
    public function getNodeType()
    {
        return 'Location';
    }
}
