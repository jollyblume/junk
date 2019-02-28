<?php

namespace OldApp\Tests\Traits;

use PHPUnit\Framework\TestCase;
use App\Traits\ComputeMethodNameTrait;

class ComputeMethodNameTraitTest extends TestCase
{
    protected function buildMockForTrait() {
        $trait = $this->getMockForTrait(ComputeMethodNameTrait::class);
        return $trait;
    }

    /**
     * @expectedException   \App\Exception\OutOfScopeException
     */
    public function testComputeMethodNameThrowsForInvalidTemplateName() {
        $trait = $this->buildMockForTrait();
        $trait->computeMethodName('testmethod');
    }
}
