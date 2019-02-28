<?php

namespace App\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;

class CookieStoreTraitFunctionalTest extends TestCase
{
    /**
     * @expectedException     \App\Exception\NodeExistsException
     */
    public function testRegisterCookieThrowsIfCookieNodeExists()
    {
        $this->markTestSkipped('todo: need a uuid');
    }

    public function testRegisterCookieReturnsIfSourceNodeCreateCookieReturnsNull()
    {
        $this->markTestSkipped('todo: need a uuid');
    }

    /**
     * @expectedException     \App\Exception\MissingInterfaceException
     */
    public function testResisterCookieThrowsIfSourceNodeCreateCookeReturnsNotCookieInterface()
    {
        $this->markTestSkipped('todo: need a uuid');
    }

    public function testRegisterCookieAddsOtherwise()
    {
        $this->markTestSkipped('todo: need a uuid');
    }

    public function testGetCookie()
    {
        $this->markTestSkipped('todo: need a uuid');
    }
}
