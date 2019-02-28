<?php

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\TeamBag;
use App\Document\TeamNode;

class TeamBagTest extends TestCase {
    public function testGetSemanticNodeType() {
        $bag = new TeamBag();
        $this->assertEquals('Team', $bag->getSemanticNodeType());
    }

    public function testAddTeamNode() {
        $bag = new TeamBag();
        $child = new TeamNode();
        $child->setNodename('test child');
        $bag->add($child);
        $this->assertEquals($child, $bag->getTeamNode('test child'));
    }

    public function testRemoveTeamNode() {
        $bag = new TeamBag();
        $child = new TeamNode();
        $child->setNodename('test child');
        $bag->add($child);
        $bag->removeElement($child);
        $this->assertFalse($bag->hasTeamNode($child));
    }

    public function testRemoveTeamName() {
        $bag = new TeamBag();
        $child = new TeamNode();
        $child->setNodename('test child');
        $bag->add($child);
        $bag->remove('test child');
        $this->assertFalse($bag->hasTeamName('test child'));
    }

    public function testSetTeamNode() {
        $bag = new TeamBag();
        $child = new TeamNode();
        $child->setNodename('test child');
        $bag->set('test child', $child);
        $this->assertTrue($bag->hasTeamName('test child'));
    }
}
