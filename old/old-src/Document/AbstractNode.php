<?php

namespace OldApp\Document;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Document\Traits\SlugifyPhpcrNodeTrait;
use App\Document\CookieStoreInterface;
use App\Document\Traits\CookieSourceTrait;
use App\Document\Traits\CookieStoreTrait;
use App\Document\Traits\PhpcrChildrenTrait;
use App\Document\Traits\PhpcrReferencableTrait;
use App\Document\MoveNodeOnRemoveInterface;
use App\Traits\ComputeMethodNameTrait;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * AbstractNode.
 *
 * Base class for all Node classes. Implements default Node behavior
 *
 * @PHPCR\Document(
 *      childClasses={"App\Document\PhpcrNodeInterface"},
 *      referenceable=true
 * )
 */
abstract class AbstractNode implements PhpcrChildrenInterface, PhpcrReferencableInterface, CookieSourceInterface, MoveNodeOnRemoveInterface, CookieStoreInterface
{
    use SlugifyPhpcrNodeTrait, PhpcrChildrenTrait, PhpcrReferencableTrait, CookieSourceTrait, CookieStoreTrait, ComputeMethodNameTrait;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }
}
