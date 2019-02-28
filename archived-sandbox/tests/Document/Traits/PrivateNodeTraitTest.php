<?php

namespace App\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\Traits\PrivateNodeTrait;

class PrivateNodeTraitTest extends TestCase {
    protected function buildMockForTrait() {
        $trait = $this->getMockForTrait(PrivateNodeTrait::class);
        return $trait;
    }

    public function testGetNodenameEmptyIfAllPropertiesNull()
    {
        $trait = $this->buildMockForTrait();
        $this->assertEquals('', $trait->getNodename());
    }

    public function testGetParentIdEmptyIfAllPropertiesNull()
    {
        $trait = $this->buildMockForTrait();
        $this->assertEquals('', $trait->getParentId());
    }

    public function testGetIdIfAllPropertiesNull()
    {
        $trait = $this->buildMockForTrait();
        $this->assertEquals('/', $trait->getId());
    }

    public function testGetParentIfParentIfNull()
    {
        $trait = $this->buildMockForTrait();
        $this->assertNull($trait->getParent());
    }

    public function testIsRootFalse()
    {
        $trait = $this->buildMockForTrait();
        $this->assertFalse($trait->isRootNode());
    }
}
