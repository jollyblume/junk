<?php

namespace App\Document;

use App\Model\NodeInterface;
use App\Model\ParentNodeInterface;
use App\Model\ReferenceableNodeInterface;
use App\Model\Traits\NodeTrait;
use App\Model\Traits\ParentNodeTrait;
use App\Model\Traits\ReferenceableNodeTrait;
use App\Store\CookieStoreInterface;
use App\Store\Traits\CookieStoreTrait;
use App\Collections\SemanticCollectionInterface;
use App\Collections\SemanticCollectionTrait;

/**
 * AbstractParentNode.
 */
abstract class AbstractParentNode implements NodeInterface, ParentNodeInterface, ReferenceableNodeInterface, SemanticCollectionInterface, CookieStoreInterface
{
    use NodeTrait, ParentNodeTrait, ReferenceableNodeTrait, SemanticCollectionTrait, CookieStoreTrait;
}
