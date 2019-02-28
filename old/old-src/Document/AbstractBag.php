<?php

namespace OldApp\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Doctrine\Common\Collections\ArrayCollection;
use App\Document\Traits\CookieStoreTrait;
use App\Document\Traits\PhpcrChildrenTrait;
use App\Document\Traits\SlugifyPhpcrNodeTrait;
use App\Document\Traits\PhpcrReferencableTrait;
use App\Document\PhpcrNodeInterface;
use App\Document\MoveNodeOnRemoveInterface;
use App\Traits\ComputeMethodNameTrait;
use App\Exception\ExceptionContext;
use App\Exception\OutOfScopeException;
use PHPCR\Util\UUIDHelper;

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
 * @PHPCR\Document(
 *      childClasses={"App\Document\CookieInterface"},
 *      referenceable=true
 * )
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
abstract class AbstractBag implements BagInterface
{
    use SlugifyPhpcrNodeTrait, PhpcrReferencableTrait, ComputeMethodNameTrait, CookieStoreTrait;
    use PhpcrChildrenTrait {
        removeChild as traitRemoveChild;
    }

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
     * Test if Bag is used for trash (deleted Nodes).
     *
     * @return bool
     */
    public function isBagTrash()
    {
        return false;
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    protected function generateTrashNodename(PhpcrNodeInterface $node) {
        $uuid = UUIDHelper::generateUUID();
        $nodename = sprintf('%s_%s', $node->getNodename(), $uuid);
        return $nodename;
    }

    protected function getTrashBagNode() {
        $trashBagClassname = ucfirst(sprintf('%sTrash', $this->getNodeType()));
        $trashBagNodename = lcfirst($trashBagClassname);
        if ($this->hasChildKey($trashBagNodename)) {
            // Nothing to do
            return $this->getChild($trashBagNodename);
        }

        $classname = sprintf('App\Document\%s', $trashBagClassname);
        $trashBag = new $classname();
        $this->set($trashBagNodename, $trashBag);
        return $trashBag;
    }

    /**
     * Remove a child element.
     *
     * @param PhpcrNodeInterface $node
     *
     * @return null|PhpcrNodeInterface Removed element
     */
    protected function removeChild(PhpcrNodeInterface $node) {
        $removedNode = $this->traitRemoveChild($node);

        if (null === $removedNode || $this->isBagTrash()) {
            // Nothing to do
            return null;
        }

        if ($removedNode instanceof MoveNodeOnRemoveInterface) {
            // todo move node to trash bag
            $nodename = $this->generateTrashNodename($node);
            $newParent = $this->getTrashBagNode();
            $this->moveNode($newParent, $nodename);
        }

        return $removedNode;
    }
}
