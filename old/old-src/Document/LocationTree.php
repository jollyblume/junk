<?php

namespace OldApp\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

/**
 * LocationTree.
 *
 * Implements TreeInterface, allowing the tree to added to the Root Node
 *
 * @PHPCR\Document()
 */
class LocationTree extends LocationBag implements TreeInterface
{
}
