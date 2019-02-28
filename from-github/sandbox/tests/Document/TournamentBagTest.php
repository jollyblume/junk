<?php

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\TournamentBag;
use App\Document\TournamentNode;

class TournamentBagTest extends TestCase {
    public function testGetSemanticNodeType() {
        $bag = new TournamentBag();
        $this->assertEquals('Tournament', $bag->getSemanticNodeType());
    }

    public function testAddTournamentNode() {
        $bag = new TournamentBag();
        $child = new TournamentNode();
        $child->setNodename('test child');
        $bag->add($child);
        $this->assertEquals($child, $bag->getTournamentNode('test child'));
    }

    public function testRemoveTournamentNode() {
        $bag = new TournamentBag();
        $child = new TournamentNode();
        $child->setNodename('test child');
        $bag->add($child);
        $bag->removeElement($child);
        $this->assertFalse($bag->hasTournamentNode($child));
    }

    public function testRemoveTournamentName() {
        $bag = new TournamentBag();
        $child = new TournamentNode();
        $child->setNodename('test child');
        $bag->add($child);
        $bag->remove('test child');
        $this->assertFalse($bag->hasTournamentName('test child'));
    }

    public function testSetTournamentNode() {
        $bag = new TournamentBag();
        $child = new TournamentNode();
        $child->setNodename('test child');
        $bag->set('test child', $child);
        $this->assertTrue($bag->hasTournamentName('test child'));
    }
}
