<?php

namespace App\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\MatchBag;
use App\Document\MatchNode;
use App\Document\TournamentNode;

class TournamentNodeTest extends TestCase {
    public function testSetMatchBagSetsBag() {
        $node = new TournamentNode();
        $bag = $this->createMock(MatchBag::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->setMatchNodes($bag);
        $this->assertEquals($bag, $node->getMatchNodes());
    }

    public function testAddMatchNode() {
        $node = new TournamentNode();
        $bag = $this->createMock(MatchNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addMatchNode($bag);
        $this->assertEquals($bag, $node->getMatchNode('testbag'));
    }

    public function testRemoveMatchNode() {
        $node = new TournamentNode();
        $bag = $this->createMock(MatchNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addMatchNode($bag);
        $node->removeMatchNode($bag);
        $this->assertFalse($node->hasMatchNode($bag));
    }

    public function testRemoveMatchName() {
        $node = new TournamentNode();
        $bag = $this->createMock(MatchNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addMatchNode($bag);
        $node->removeMatchName('testbag');
        $this->assertFalse($node->hasMatchName('testbag'));
    }

    public function testSetMatchNode() {
        $node = new TournamentNode();
        $bag = $this->createMock(MatchNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->setMatchNode('testbag', $bag);
        $this->assertTrue($node->hasMatchNode($bag));
    }
}
