<?php

namespace App\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\Traits\PhpcrLeagueStoreTrait;
use App\Model\LeagueInterface;
use App\Model\LeagueStoreInterface;

class PhpcrLeagueStoreTraitTest extends TestCase {
    public function testSetLeagueBagSetsBag() {
        $trait = $this->getMockForTrait(PhpcrLeagueStoreTrait::class);
        $bag = $this->createMock(LeagueStoreInterface::class);
        $bag->method('getNodename')->willReturn('testbag');
        $trait->setLeagueNodes($bag);
        $this->assertEquals($bag, $trait->getLeagueNodes());
    }

    public function testAddLeagueNode() {
        $trait = $this->getMockForTrait(PhpcrLeagueStoreTrait::class);
        $node = $this->createMock(LeagueInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->addLeagueNode($node);
        $this->assertEquals($node, $trait->getLeagueNode('testnode'));
    }

    public function testRemoveLeagueNode() {
        $trait = $this->getMockForTrait(PhpcrLeagueStoreTrait::class);
        $node = $this->createMock(LeagueInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->addLeagueNode($node);
        $trait->removeLeagueNode($node);
        $this->assertFalse($trait->hasLeagueNode($node));
    }

    public function testRemoveLeagueName() {
        $trait = $this->getMockForTrait(PhpcrLeagueStoreTrait::class);
        $node = $this->createMock(LeagueInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->addLeagueNode($node);
        $trait->removeLeagueName('testnode');
        $this->assertFalse($trait->hasLeagueName('testnode'));
    }

    public function testSetLeagueNode() {
        $trait = $this->getMockForTrait(PhpcrLeagueStoreTrait::class);
        $node = $this->createMock(LeagueInterface::class);
        $node->method('getNodename')->willReturn('testnode');
        $trait->setLeagueNode('testnode', $node);
        $this->assertTrue($trait->hasLeagueNode($node));
    }
}
