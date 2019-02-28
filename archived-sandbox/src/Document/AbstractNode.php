<?php

namespace App\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Document\Traits\SlugifyPhpcrNodeTrait;
use App\Document\Traits\CookieStoreTrait;
use App\Document\Traits\CookieSourceTrait;
use App\Document\Traits\PhpcrChildrenTrait;
use App\Document\Traits\PhpcrReferencableTrait;
<<<<<<< HEAD
use App\Document\BagInterface;
=======
use App\Traits\ComputeMethodNameTrait;
>>>>>>> move-collection-to-children
use Doctrine\Common\Collections\ArrayCollection;

/**
 * AbstractNode.
 *
 * Base class for all Node classes. Implements default Node behavior
 *
 * @PHPCR\Document(referenceable=true)
 */
abstract class AbstractNode implements PhpcrChildrenInterface, PhpcrReferencableInterface, CookieStoreInterface, CookieSourceInterface
{
    use SlugifyPhpcrNodeTrait, PhpcrChildrenTrait, PhpcrReferencableTrait, CookieStoreTrait, CookieSourceTrait;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    /**
     * Get the computeMethodName Accessor Map
     *
     * @return array
     */
    public function getAccessorMap() {
        $map = [
            'addNode' => 'add%sNode',
            'hasNode' => 'has%sNode',
            'hasName' => 'has%sName',
            'removeNode' => 'remove%sNode',
            'removeName' => 'remove%sName',
            'getNode' => 'get%sNode',
        ];
        return $map;
    }
}
