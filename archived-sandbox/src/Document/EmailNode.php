<?php

namespace App\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

/**
 * EmailNode.
 *
 * This is a concrete Document Node.
 *
 * Each Email Node is referenced by Document Nodes that use the address for some
 * purpose. A Cookie will be stored on the referencing Document Node containing
 * data related to how the address is used by that Document Node.
 *
 * Ultimately, every Email Node is owned by a single Player Node.
 *
 * An Email Node as no extra properties.
 *
 * @PHPCR\Document()
 */
class EmailNode extends AbstractNode
{
}
