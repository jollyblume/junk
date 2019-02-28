<?php

namespace App\Tests\Document\Traits;

use PHPUnit\Framework\TestCase;
use App\Document\CookieStoreInterface;
use App\Document\Traits\CookieSourceTrait;
use App\Document\GenericCookie;

class CookieSourceTraitTest extends TestCase
{
    protected function buildMockForTrait() {
        $trait = $this->getMockForTrait(CookieSourceTrait::class);
        return $trait;
    }

    public function testCreateCookieReturnsGenericCookie()
    {
        $trait = $this->buildMockForTrait();
        $storeNode = $this->createMock(CookieStoreInterface::class);
        $storeNode->method('getId')->willReturn('/testid');
        $cookie = $trait->createCookie($storeNode);
        $this->assertInstanceOf(GenericCookie::class, $cookie);
    }
}
