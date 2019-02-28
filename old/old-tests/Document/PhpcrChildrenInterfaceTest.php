<?php

namespace OldApp\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\PhpcrNodeInterface;
use App\Document\PhpcrChildrenInterface;

class PhpcrChildrenInterfaceTest extends TestCase
{
    public function testExtendsPhpcrNodeInterface()
    {
        $tree = $this->createMock(PhpcrChildrenInterface::class);
        $this->assertInstanceOf(PhpcrNodeInterface::class, $tree);
    }
}
