<?php

namespace App\Document;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Model\NodeInterface;
use App\Model\StoreInterface;
use App\Model\ParentNodeInterface;
use App\Model\CookieStoreInterface;
use App\Model\ReferencableNodeInterface;
use App\Document\Traits\PhpcrNodeTrait;
use App\Document\Traits\PhpcrParentNodeTrait;
use App\Document\Traits\PhpcrReferencableNodeTrait;
use App\Collections\SemanticCollectionInterface;
use App\Traits\CookieStoreTrait;
use App\Traits\SemanticCollectionTrait;
/**
 * AbstractParentNode
 *
 * @PHPCR\Document(
 *      childClasses={"App\Model\CookieInterface"},
 *      referenceable=true
 * );
 */
abstract class AbstractParentNode implements NodeInterface, ParentNodeInterface, ReferencableNodeInterface, SemanticCollectionInterface, CookieStoreInterface {
    use PhpcrNodeTrait, PhpcrParentNodeTrait, PhpcrReferencableNodeTrait, SemanticCollectionTrait, CookieStoreTrait;
}
