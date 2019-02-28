<?php

namespace App\Tests\Collections;

use PHPUnit\Framework\TestCase;
use App\Collections\SemanticCollectionTrait;

class SemanticCollectionTraitTest extends TestCase {
    /**
     * @expectedException       App\Exception\OutOfScopeException
     */
    public function testGetSemanticMethodNameThrowsForInvalidTemplateName() {
        $trait = $this->getMockForTrait(SemanticCollectionTrait::class);
        $trait->getSemanticMethodName('notatemplate');
    }
}
