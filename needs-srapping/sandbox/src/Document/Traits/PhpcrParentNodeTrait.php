<?php

namespace App\Document\Traits;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Traits\ParentNodeTrait;

trait PhpcrParentNodeTrait
{
    use ParentNodeTrait;

    /**
     * Phpcr Children collection.
     *
     * @var Collection
     * @PHPCR\Children()
     */
    private $children;

    /**
     * Low-level getter implemented by persistence layer.
     *
     * @return Collection
     */
    private function getChildrenFromStore()
    {
        $children = $this->children;

        if (null === $children) {
            $children = new ArrayCollection();
            $this->children = $children;
        }

        return $children;
    }
}
