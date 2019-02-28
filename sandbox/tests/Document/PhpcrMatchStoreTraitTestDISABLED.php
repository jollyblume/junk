<?php

namespace App\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\Traits\PhpcrMatchStoreTrait;
use App\Model\MatchInterface;
use App\Model\MatchStoreInterface;

class PhpcrMatchStoreTraitTest extends TestCase {
    public function testSetMatchBagSetsBag() {
        $trait = $this->getMockForTrait(PhpcrMatchStoreTrait::class);
        $bag = $this->createMock(MatchStoreInterface::class);
        $bag->method('getNodename')->willReturn('testbag');
        $trait->setMatchNodes($bag);
        $this->assertEquals($bag, $trait->getMatchNodes());
    }

    public function testAddMatchNode() {
        $trait = $this->getMockForTrait(PhpcrMatchStoreTrait::class);
        $node = $this->createMock(MatchInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->addMatchNode($node);
        $this->assertEquals($node, $trait->getMatchNode('testnode'));
    }

    public function testRemoveMatchNode() {
        $trait = $this->getMockForTrait(PhpcrMatchStoreTrait::class);
        $node = $this->createMock(MatchInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->addMatchNode($node);
        $trait->removeMatchNode($node);
        $this->assertFalse($trait->hasMatchNode($node));
    }

    public function testRemoveMatchName() {
        $trait = $this->getMockForTrait(PhpcrMatchStoreTrait::class);
        $node = $this->createMock(MatchInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->addMatchNode($node);
        $trait->removeMatchName('testnode');
        $this->assertFalse($trait->hasMatchName('testnode'));
    }

    public function testSetMatchNode() {
        $trait = $this->getMockForTrait(PhpcrMatchStoreTrait::class);
        $node = $this->createMock(MatchInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->setMatchNode('testnode', $node);
        $this->assertTrue($trait->hasMatchNode($node));
    }
}
