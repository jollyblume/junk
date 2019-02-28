<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Model;

use YoYogaBear\Bundle\PhpcrBundle\Model\NodeInterface;

/**
 * LinkableInterface
 */
interface LinkableInterface extends NodeInterface
{
    /**
     * Get the node's UUID.
     *
     * @return string The node's uuid
     */
    public function getUuid(): string;
}
