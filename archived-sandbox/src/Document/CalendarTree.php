<?php

namespace App\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

/**
 * CalendarTree.
 *
 * Implements TreeInterface, allowing the tree to added to the Root Node
 *
 * @PHPCR\Document()
 */
class CalendarTree extends CalendarBag implements TreeInterface
{
}
