<?php

namespace OldApp\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\CookieStoreInterface;
use App\Document\PhpcrChildrenInterface;

class CookieStoreInterfaceTest extends TestCase
{
    public function testExtendsPhpcrChildrenInterface()
    {
        $tree = $this->createMock(CookieStoreInterface::class);
        $this->assertInstanceOf(PhpcrChildrenInterface::class, $tree);
    }
}
