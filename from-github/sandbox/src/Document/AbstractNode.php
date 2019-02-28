<?php

namespace App\Document;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Model\NodeInterface;
use App\Model\StoreInterface;
use App\Model\CookieInterface;
use App\Model\ParentNodeInterface;
use App\Model\CookieStoreInterface;
use App\Model\ReferencableNodeInterface;
use App\Document\Traits\PhpcrNodeTrait;
use App\Document\Traits\PhpcrParentNodeTrait;
use App\Document\Traits\PhpcrReferencableNodeTrait;
use App\Traits\CookieStoreTrait;

/**
 * AbstractNode
 *
 * @PHPCR\Document(
 *      childClasses={"App\Model\CookieInterface"},
 *      referenceable=true
 * );
 */
abstract class AbstractNode implements NodeInterface, ParentNodeInterface, ReferencableNodeInterface, StoreInterface {
    use PhpcrNodeTrait, PhpcrParentNodeTrait, PhpcrReferencableNodeTrait, CookieStoreTrait;
}
