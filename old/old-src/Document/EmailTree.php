<?php

namespace OldApp\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

/**
 * EmailTree.
 *
 * Implements TreeInterface, allowing the tree to added to the Root Node
 *
 * @PHPCR\Document()
 */
class EmailTree extends EmailBag implements TreeInterface
{
}
