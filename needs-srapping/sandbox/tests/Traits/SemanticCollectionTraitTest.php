<?php

namespace App\Tests\Traits;
use PHPUnit\Framework\TestCase;
use App\Traits\SemanticCollectionTrait;
class SemanticCollectionTraitTest extends TestCase {
    /**
     * @expectedException       App\Exception\OutOfScopeException
     */
    public function testGetSemanticMethodNameThrowsForInvalidTemplateName() {
        $trait = $this->getMockForTrait(SemanticCollectionTrait::class);
        $trait->getSemanticMethodName('notatemplate');
    }
}
