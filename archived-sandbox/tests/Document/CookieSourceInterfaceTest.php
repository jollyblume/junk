<?php

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\CookieSourceInterface;
use App\Document\PhpcrReferencableInterface;

class CookieSourceInterfaceTest extends TestCase
{
    public function testExtendsPhpcrChildrenInterface()
    {
        $sourceNode = $this->createMock(CookieSourceInterface::class);
        $this->assertInstanceOf(PhpcrReferencableInterface::class, $sourceNode);
    }
}
