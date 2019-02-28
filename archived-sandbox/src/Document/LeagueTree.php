<?php

namespace App\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

/**
 * LeagueTree.
 *
 * Implements TreeInterface, allowing the tree to added to the Root Node
 *
 * @PHPCR\Document()
 */
class LeagueTree extends LeagueBag implements TreeInterface
{
}
