<?php

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\PlayerBag;
use App\Document\PlayerNode;

class PlayerBagTest extends TestCase {
    public function testGetSemanticNodeType() {
        $bag = new PlayerBag();
        $this->assertEquals('Player', $bag->getSemanticNodeType());
    }

    public function testAddPlayerNode() {
        $bag = new PlayerBag();
        $child = new PlayerNode();
        $child->setNodename('test child');
        $bag->add($child);
        $this->assertEquals($child, $bag->getPlayerNode('test child'));
    }

    public function testRemovePlayerNode() {
        $bag = new PlayerBag();
        $child = new PlayerNode();
        $child->setNodename('test child');
        $bag->add($child);
        $bag->removeElement($child);
        $this->assertFalse($bag->hasPlayerNode($child));
    }

    public function testRemovePlayerName() {
        $bag = new PlayerBag();
        $child = new PlayerNode();
        $child->setNodename('test child');
        $bag->add($child);
        $bag->remove('test child');
        $this->assertFalse($bag->hasPlayerName('test child'));
    }

    public function testSetPlayerNode() {
        $bag = new PlayerBag();
        $child = new PlayerNode();
        $child->setNodename('test child');
        $bag->set('test child', $child);
        $this->assertTrue($bag->hasPlayerName('test child'));
    }
}
