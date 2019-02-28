<?php

namespace App\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\Traits\PhpcrLocationStoreTrait;
use App\Model\LocationInterface;
use App\Model\LocationStoreInterface;

class PhpcrLocationStoreTraitTest extends TestCase {
    public function testSetLocationBagSetsBag() {
        $trait = $this->getMockForTrait(PhpcrLocationStoreTrait::class);
        $bag = $this->createMock(LocationStoreInterface::class);
        $bag->method('getNodename')->willReturn('testbag');
        $trait->setLocationNodes($bag);
        $this->assertEquals($bag, $trait->getLocationNodes());
    }

    public function testAddLocationNode() {
        $trait = $this->getMockForTrait(PhpcrLocationStoreTrait::class);
        $node = $this->createMock(LocationInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->addLocationNode($node);
        $this->assertEquals($node, $trait->getLocationNode('testnode'));
    }

    public function testRemoveLocationNode() {
        $trait = $this->getMockForTrait(PhpcrLocationStoreTrait::class);
        $node = $this->createMock(LocationInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->addLocationNode($node);
        $trait->removeLocationNode($node);
        $this->assertFalse($trait->hasLocationNode($node));
    }

    public function testRemoveLocationName() {
        $trait = $this->getMockForTrait(PhpcrLocationStoreTrait::class);
        $node = $this->createMock(LocationInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->addLocationNode($node);
        $trait->removeLocationName('testnode');
        $this->assertFalse($trait->hasLocationName('testnode'));
    }

    public function testSetLocationNode() {
        $trait = $this->getMockForTrait(PhpcrLocationStoreTrait::class);
        $node = $this->createMock(LocationInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->setLocationNode('testnode', $node);
        $this->assertTrue($trait->hasLocationNode($node));
    }
}
