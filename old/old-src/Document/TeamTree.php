<?php

namespace OldApp\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

/**
 * TeamTree.
 *
 * Implements TreeInterface, allowing the tree to added to the Root Node
 *
 * @PHPCR\Document()
 */
class TeamTree extends TeamBag implements TreeInterface
{
}
