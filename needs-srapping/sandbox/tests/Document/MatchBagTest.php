<?php

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\MatchBag;
use App\Document\MatchNode;

class MatchBagTest extends TestCase {
    public function testGetSemanticNodeType() {
        $bag = new MatchBag();
        $this->assertEquals('Match', $bag->getSemanticNodeType());
    }

    public function testAddMatchNode() {
        $bag = new MatchBag();
        $child = new MatchNode();
        $child->setNodename('test child');
        $bag->add($child);
        $this->assertEquals($child, $bag->getMatchNode('test child'));
    }

    public function testRemoveMatchNode() {
        $bag = new MatchBag();
        $child = new MatchNode();
        $child->setNodename('test child');
        $bag->add($child);
        $bag->removeElement($child);
        $this->assertFalse($bag->hasMatchNode($child));
    }

    public function testRemoveMatchName() {
        $bag = new MatchBag();
        $child = new MatchNode();
        $child->setNodename('test child');
        $bag->add($child);
        $bag->remove('test child');
        $this->assertFalse($bag->hasMatchName('test child'));
    }

    public function testSetMatchNode() {
        $bag = new MatchBag();
        $child = new MatchNode();
        $child->setNodename('test child');
        $bag->set('test child', $child);
        $this->assertTrue($bag->hasMatchName('test child'));
    }
}
