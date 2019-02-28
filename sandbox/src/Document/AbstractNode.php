<?php

namespace App\Document;

use App\Model\NodeInterface;
use App\Model\ParentNodeInterface;
use App\Model\ReferenceableNodeInterface;
use App\Model\Traits\NodeTrait;
use App\Model\Traits\ParentNodeTrait;
use App\Model\Traits\ReferenceableNodeTrait;
use App\Store\StoreInterface;
use App\Store\Traits\CookieStoreTrait;

/**
 * AbstractNode.
 */
abstract class AbstractNode implements NodeInterface, ParentNodeInterface, ReferenceableNodeInterface, StoreInterface {
    use NodeTrait, ParentNodeTrait, ReferenceableNodeTrait, CookieStoreTrait;
}
