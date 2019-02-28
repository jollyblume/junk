<?php

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\GenericCookie;
use App\Document\CookieInterface;

class GenericCookieTest extends TestCase
{
    public function testImplementsCookieInterface()
    {
        $cookie = new GenericCookie();
        $this->assertInstanceOf(CookieInterface::class, $cookie);
    }

    public function testGetProperties()
    {
        $cookie = new GenericCookie();
        $this->assertEquals([], $cookie->getProperties());
    }

    public function testAddPropertyAddsIfMissing()
    {
        $cookie = new GenericCookie();
        $cookie->addProperty('testproperty', 'testvalue');
        $value = $cookie->getProperty('testproperty');
        $this->assertEquals('testvalue', $value);
    }

    /**
     * @expectedException     \App\Exception\NoSuchPropertyException
     */
    public function testSetPropertyThrowsIfMissing()
    {
        $cookie = new GenericCookie();
        $cookie->setProperty('testproperty', 'testvalue');
    }

    public function testAddPropertyOverwritesIfExists()
    {
        $cookie = new GenericCookie();
        $cookie->addProperty('testproperty', 'testvalue1');
        $cookie->addProperty('testproperty', 'testvalue2');
        $value = $cookie->getProperty('testproperty');
        $this->assertEquals('testvalue2', $value);
    }

    public function testSetPropertyOverwritesIfExists()
    {
        $cookie = new GenericCookie();
        $cookie->addProperty('testproperty', 'testvalue1');
        $cookie->setProperty('testproperty', 'testvalue2');
        $value = $cookie->getProperty('testproperty');
        $this->assertEquals('testvalue2', $value);
    }

    /**
     * @expectedException     \App\Exception\NoSuchPropertyException
     */
    public function testGetPropertyThrowsIfMissing()
    {
        $cookie = new GenericCookie();
        $cookie->getProperty('testproperty');
    }

    /**
     * @expectedException     \App\Exception\NoSuchPropertyException
     */
    public function testRemovePropertyThrowsIfMissing()
    {
        $cookie = new GenericCookie();
        $cookie->removeProperty('testproperty');
    }

    public function testRemovePropertyRemovesIfExists()
    {
        $cookie = new GenericCookie();
        $cookie->addProperty('testproperty', 'testvalue1');
        $cookie->removeProperty('testproperty');
        $this->assertFalse($cookie->hasProperty('testproperty'));
    }

    public function testRemovePropertyReturnsOriginalValue()
    {
        $cookie = new GenericCookie();
        $cookie->addProperty('testproperty', 'testvalue1');
        $value = $cookie->removeProperty('testproperty');
        $this->assertEquals('testvalue1', $value);
    }

    public function testSetPropertiesClearsAndSets()
    {
        $cookie = new GenericCookie();
        $cookie->addProperty('testproperty', 'testvalue1');
        $replacesProperties = [
            'testproperty2' => 'testvalue2',
        ];
        $cookie->setProperties($replacesProperties);
        $this->assertFalse($cookie->hasProperty('testproperty'));
        $this->assertTrue($cookie->hasProperty('testproperty2'));
    }
}
