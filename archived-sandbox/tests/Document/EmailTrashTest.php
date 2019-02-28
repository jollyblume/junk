<?php

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\EmailTrash;
use App\Document\EmailNode;

class EmailTrashTest extends TestCase
{
    public function testGetNodeType()
    {
        $trashBag = new EmailTrash();
        $this->assertEquals('EmailTrash', $trashBag->getNodeType());
    }

    public function testAddEmailTrashNode()
    {
        $trashBag = new EmailTrash();
        $trash = $this->createMock(EmailNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addEmailTrashNode($trash);
        $this->assertEquals($trash, $trashBag->getEmailTrashNode('testnodename'));
    }

    public function testRemoveEmailTrashNode()
    {
        $trashBag = new EmailTrash();
        $trash = $this->createMock(EmailNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addEmailTrashNode($trash);
        $trashBag->removeEmailTrashNode($trash);
        $this->assertFalse($trashBag->hasEmailTrashNode($trash));
    }

    public function testRemoveEmailTrashName()
    {
        $trashBag = new EmailTrash();
        $trash = $this->createMock(EmailNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addEmailTrashNode($trash);
        $trashBag->removeEmailTrashName('testnodename');
        $this->assertFalse($trashBag->hasEmailTrashName('testnodename'));
    }

    public function testGetEmailTrashNode()
    {
        $trashBag = new EmailTrash();
        $trash = $this->createMock(EmailNode::class);
        $trash->method('getNodename')->willReturn('testnodename');
        $trashBag->addEmailTrashNode($trash);
        $gottenTrash = $trashBag->getEmailNode('testnodename');
        $this->assertEquals($trash, $gottenTrash);
    }

    public function testSetEmailTrashNode()
    {
        $this->markTestSkipped('need functional test');
    }
}
