<?php

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\EmailBag;
use App\Document\EmailNode;

class EmailBagTest extends TestCase {
    public function testGetSemanticNodeType() {
        $bag = new EmailBag();
        $this->assertEquals('Email', $bag->getSemanticNodeType());
    }

    public function testAddEmailNode() {
        $bag = new EmailBag();
        $child = new EmailNode();
        $child->setNodename('test child');
        $bag->add($child);
        $this->assertEquals($child, $bag->getEmailNode('test child'));
    }

    public function testRemoveEmailNode() {
        $bag = new EmailBag();
        $child = new EmailNode();
        $child->setNodename('test child');
        $bag->add($child);
        $bag->removeElement($child);
        $this->assertFalse($bag->hasEmailNode($child));
    }

    public function testRemoveEmailName() {
        $bag = new EmailBag();
        $child = new EmailNode();
        $child->setNodename('test child');
        $bag->add($child);
        $bag->remove('test child');
        $this->assertFalse($bag->hasEmailName('test child'));
    }

    public function testSetEmailNode() {
        $bag = new EmailBag();
        $child = new EmailNode();
        $child->setNodename('test child');
        $bag->set('test child', $child);
        $this->assertTrue($bag->hasEmailName('test child'));
    }
}
