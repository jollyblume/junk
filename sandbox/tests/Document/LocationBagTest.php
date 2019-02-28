<?php

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\LocationBag;
use App\Document\LocationNode;

class LocationBagTest extends TestCase {
    public function testGetSemanticNodeType() {
        $bag = new LocationBag();
        $this->assertEquals('Location', $bag->getSemanticNodeType());
    }

    public function testAddLocationNode() {
        $bag = new LocationBag();
        $child = new LocationNode();
        $child->setNodename('test child');
        $bag->add($child);
        $this->assertEquals($child, $bag->getLocationNode('test child'));
    }

    public function testRemoveLocationNode() {
        $bag = new LocationBag();
        $child = new LocationNode();
        $child->setNodename('test child');
        $bag->add($child);
        $bag->removeElement($child);
        $this->assertFalse($bag->hasLocationNode($child));
    }

    public function testRemoveLocationName() {
        $bag = new LocationBag();
        $child = new LocationNode();
        $child->setNodename('test child');
        $bag->add($child);
        $bag->remove('test child');
        $this->assertFalse($bag->hasLocationName('test child'));
    }

    public function testSetLocationNode() {
        $bag = new LocationBag();
        $child = new LocationNode();
        $child->setNodename('test child');
        $bag->set('test child', $child);
        $this->assertTrue($bag->hasLocationName('test child'));
    }
}
