<?php

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\AbstractNode;
use App\Model\CookieInterface;

class AbstractNodeTest extends TestCase {
    public function  testAddCookieNode() {
        $parent = $this->getMockForAbstractClass(AbstractNode::class);
        $cookie = $this->createMock(CookieInterface::class);
        $cookie->method('getNodeName')->willReturn('test cookie');
        $cookie->method('getParent')->willReturn($parent);
        $parent->addCookieNode($cookie);
        $this->assertEquals($cookie, $parent->getCookieNode('test cookie'));
    }

    public function testRemoveCookieNode() {
        $parent = $this->getMockForAbstractClass(AbstractNode::class);
        $cookie = $this->createMock(CookieInterface::class);
        $cookie->method('getNodeName')->willReturn('test cookie');
        $cookie->method('getParent')->willReturn($parent);
        $parent->addCookieNode($cookie);
        $parent->removeCookieNode($cookie);
        $this->assertFalse($parent->hasCookieNode($cookie));
    }

    public function testRemoveCookieName() {
        $parent = $this->getMockForAbstractClass(AbstractNode::class);
        $cookie = $this->createMock(CookieInterface::class);
        $cookie->method('getNodeName')->willReturn('test cookie');
        $cookie->method('getParent')->willReturn($parent);
        $parent->addCookieNode($cookie);
        $parent->removeCookieName('test cookie');
        $this->assertFalse($parent->hasCookieName('test cookie'));
    }

    public function testSetCookieNode() {
        $parent = $this->getMockForAbstractClass(AbstractNode::class);
        $cookie = $this->createMock(CookieInterface::class);
        $cookie->method('getNodeName')->willReturn('test cookie');
        $cookie->method('getParent')->willReturn($parent);
        $parent->setCookieNode('test cookie', $cookie);
        $this->assertTrue($parent->hasCookieName('test cookie'));
    }
}
