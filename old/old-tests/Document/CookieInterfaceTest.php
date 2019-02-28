<?php

namespace OldApp\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\CookieInterface;
use App\Document\PhpcrNodeInterface;

class CookieInterfaceTest extends TestCase
{
    public function testExtendsPhpcrNodeInterface()
    {
        $cookie = $this->createMock(CookieInterface::class);
        $this->assertInstanceOf(PhpcrNodeInterface::class, $cookie);
    }
}
