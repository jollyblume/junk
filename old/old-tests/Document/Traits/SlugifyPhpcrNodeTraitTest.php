<?php

namespace OldApp\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\Traits\SlugifyPhpcrNodeTrait;

class SlugifyPhpcrNodeTraitTest extends TestCase
{
    protected function buildMockForTrait() {
        $trait = $this->getMockForTrait(SlugifyPhpcrNodeTrait::class);
        return $trait;
    }

    public function testSetNodenameSingleWordSlugUnchanged() {
        $trait = $this->buildMockForTrait();
        $trait->setNodename('testnodename');
        $this->assertEquals('testnodename', $trait->getNodename());
    }

    public function testSetNodenameSlugUnchanged() {
        $trait = $this->buildMockForTrait();
        $trait->setNodename('test-node-name');
        $this->assertEquals('test-node-name', $trait->getNodename());
    }

    public function testSetIdSingleWordUnchanged() {
        $trait = $this->buildMockForTrait();
        $trait->setId('/parent/testnodename');
        $this->assertEquals('testnodename', $trait->getNodename());
    }

    public function testSetIdSlugUnchanged() {
        $trait = $this->buildMockForTrait();
        $trait->setId('/parent/test-node-name');
        $this->assertEquals('test-node-name', $trait->getNodename());
    }
}
