<?php

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\LocationTrash;
use App\Document\LocationNode;

class LocationTrashTest extends TestCase
{
    public function testGetNodeType()
    {
        $trashBag = new LocationTrash();
        $this->assertEquals('LocationTrash', $trashBag->getNodeType());
    }

    public function testAddLocationTrashNode()
    {
        $trashBag = new LocationTrash();
        $trash = $this->createMock(LocationNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addLocationTrashNode($trash);
        $this->assertEquals($trash, $trashBag->getLocationTrashNode('testnodename'));
    }

    public function testRemoveLocationTrashNode()
    {
        $trashBag = new LocationTrash();
        $trash = $this->createMock(LocationNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addLocationTrashNode($trash);
        $trashBag->removeLocationTrashNode($trash);
        $this->assertFalse($trashBag->hasLocationTrashNode($trash));
    }

    public function testRemoveLocationTrashName()
    {
        $trashBag = new LocationTrash();
        $trash = $this->createMock(LocationNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addLocationTrashNode($trash);
        $trashBag->removeLocationTrashName('testnodename');
        $this->assertFalse($trashBag->hasLocationTrashName('testnodename'));
    }

    public function testGetLocationTrashNode()
    {
        $trashBag = new LocationTrash();
        $trash = $this->createMock(LocationNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addLocationTrashNode($trash);
        $gottenTrash = $trashBag->getLocationNode('testnodename');
        $this->assertEquals($trash, $gottenTrash);
    }

    public function testSetLocationTrashNode()
    {
        $this->markTestSkipped('need functional test');
    }
}
