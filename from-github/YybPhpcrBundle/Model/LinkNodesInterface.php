<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Model;

use Doctrine\Common\Collections\Collection;

/**
 * LinkNodesInterface
 */
interface LinkNodesInterface
{
    /**
     * Get the collection of link nodes (hard references)
     *
     * @return Collection The collection of link nodes
     */
    public function getLinkNodes(): Collection;
}
