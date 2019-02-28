<?php

namespace OldApp\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\PlayerBag;
use App\Document\PlayerNode;
use App\Document\GenericCookie;
use App\Document\Traits\CookieStoreTrait;

class CookieStoreTraitFunctionalTest extends TestCase
{
    use CookieStoreTrait;

    /**
     * @expectedException     \App\Exception\NodeExistsException
     */
    public function testRegisterCookieThrowsIfCookieNodeExists()
    {
        $sourceNode = new PlayerNode();
        $sourceNode->setNodename('testcookiesource');
        $storeNode = new PlayerNode();
        $storeNode->setNodename('testcookiestore');
        $storeNode->registerCookie($sourceNode);
        $this->assertTrue($storeNode->hasCookie($sourceNode));
        $storeNode->registerCookie($sourceNode);
    }

    public function testRegisterCookieReturnsIfNoCookieCreated()
    {
        $sourceNode = $this->createMock(PlayerNode::class);
        $sourceNode->method('getCookieNodename')->willReturn('testcookiesource_testcookiestore');
        $sourceNode->method('createCookie')->willReturn(null);
        $sourceNode->method('getNodename')->willReturn('testcookiesource');
        $storeNode = new PlayerNode();
        $storeNode->setNodename('testcookiestore');
        $storeNode->registerCookie($sourceNode);
        $this->assertEmpty($storeNode);
    }

    /**
     * @expectedException   App\Exception\MissingInterfaceException
     */
    public function testRegisterCookieThrowsIfNotCookieInterface() {
        $cookie = $this->createMock(PlayerNode::class);
        $sourceNode = $this->createMock(PlayerNode::class);
        $sourceNode->method('getCookieNodename')->willReturn('testcookiesource_testcookiestore');
        $sourceNode->method('createCookie')->willReturn($cookie);
        $sourceNode->method('getNodename')->willReturn('testcookiesource');
        $storeNode = new PlayerNode();
        $storeNode->registerCookie($sourceNode);
        dump($sourceNode);
    }

    public function testRegisterCookie() {
        $sourceNode = new PlayerNode();
        $sourceNode->setNodename('testcookiesource');
        $storeNode = new PlayerNode();
        $storeNode->setNodename('testcookiestore');
        $storeNode->registerCookie($sourceNode);
        $cookie = $storeNode->getCookie($sourceNode);
        $expectedNodename = 'testcookiesource_testcookiestore';
        $this->assertEquals($expectedNodename, $cookie->getNodename());
    }
}
