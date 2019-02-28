<?php

namespace OldApp\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\TreeInterface;
use App\Document\PhpcrChildrenInterface;

class TreeInterfaceTest extends TestCase
{
    public function testExtendsPhpcrChildrenInterface()
    {
        $tree = $this->createMock(TreeInterface::class);
        $this->assertInstanceOf(PhpcrChildrenInterface::class, $tree);
    }
}
