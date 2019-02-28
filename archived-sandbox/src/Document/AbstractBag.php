<?php

namespace App\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Doctrine\Common\Collections\ArrayCollection;
use App\Document\Traits\PhpcrChildrenTrait;
use App\Document\Traits\SlugifyPhpcrNodeTrait;
use App\Document\Traits\PhpcrReferencableTrait;
use App\Traits\ComputeMethodNameTrait;

/**
 * AbstractBag.
 *
 * Implements BagInterface
 *
 * There is a single concrete Bag Class for each type of Document Node.
 *
 * Concrete classes must implement two abstract methods:
 *   - getNodeType()
 *     Returns a single word descriptive string for the Bag. The Node Type will
 *     indicate the type of Document Node the Bag supports
 *     ('player', 'team', 'league', 'tournament', etc.).
 *   - supports()
 *     Tests a Node to ensure the Node is supported by the Bag
 *
 * Bag Nodes extend several collection interfaces:
 *   - Doctrine\Common\Collections\Collection
 *   - Doctrine\Common\Collections\Selectable
 *   - Countable
 *   - IteratorAggregate
 *   - ArrayAccess
 *
 * AbstractBag implements all of them.
 *
 * @PHPCR\Document(referenceable=true)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
abstract class AbstractBag implements BagInterface
{
    use SlugifyPhpcrNodeTrait, PhpcrChildrenTrait, PhpcrReferencableTrait, ComputeMethodNameTrait;

    /**
     * Constructor.
     *
     * Initialize $this->children
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->isBagTrash = false;
    }

    /**
     * Get the computeMethodName Accessor Map.
     *
     * @return array
     */
    public function getAccessorMap()
    {
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

    /**
     * Test if Bag is used for trash (deleted Nodes).
     *
     * @return bool
     */
    public function isBagTrash()
    {
        return false;
    }
}
