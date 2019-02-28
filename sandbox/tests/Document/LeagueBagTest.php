<?php

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\LeagueBag;
use App\Document\LeagueNode;

class LeagueBagTest extends TestCase {
    public function testGetSemanticNodeType() {
        $bag = new LeagueBag();
        $this->assertEquals('League', $bag->getSemanticNodeType());
    }

    public function testAddLeagueNode() {
        $bag = new LeagueBag();
        $child = new LeagueNode();
        $child->setNodename('test child');
        $bag->add($child);
        $this->assertEquals($child, $bag->getLeagueNode('test child'));
    }

    public function testRemoveLeagueNode() {
        $bag = new LeagueBag();
        $child = new LeagueNode();
        $child->setNodename('test child');
        $bag->add($child);
        $bag->removeElement($child);
        $this->assertFalse($bag->hasLeagueNode($child));
    }

    public function testRemoveLeagueName() {
        $bag = new LeagueBag();
        $child = new LeagueNode();
        $child->setNodename('test child');
        $bag->add($child);
        $bag->remove('test child');
        $this->assertFalse($bag->hasLeagueName('test child'));
    }

    public function testSetLeagueNode() {
        $bag = new LeagueBag();
        $child = new LeagueNode();
        $child->setNodename('test child');
        $bag->set('test child', $child);
        $this->assertTrue($bag->hasLeagueName('test child'));
    }
}
