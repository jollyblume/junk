<?php

namespace OldApp\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\PlayerBag;
use App\Document\PlayerNode;
use App\Document\GenericCookie;

class CookieSourceTraitFunctionTest extends TestCase
{
    public function testCreateCookieReturnsGenericCookie()
    {
        $sourceNode = new PlayerNode();
        $sourceNode->setNodename('testcookiesource');
        $storeNode = new PlayerBag();
        $storeNode->setNodename('testcookiestore');
        $cookie = $sourceNode->createCookie($storeNode);
        $this->assertInstanceOf(GenericCookie::class, $cookie);
        return $cookie;
    }

    /**
     * @depends testCreateCookieReturnsGenericCookie
     */
    public function testCreateCookieSetsNodename(GenericCookie $cookie) {
        $this->assertNotEmpty($cookie->getNodename());
    }

    public function testGetCookieNodename() {
        $sourceNode = new PlayerNode();
        $sourceNode->setNodename('testcookiesource');
        $storeNode = new PlayerBag();
        $storeNode->setNodename('testcookiestore');
        $cookieNodename = $sourceNode->getCookieNodename($storeNode);
        $expectedNodename = 'testcookiesource_testcookiestore';
        $this->assertEquals($expectedNodename, $cookieNodename);
    }
}
