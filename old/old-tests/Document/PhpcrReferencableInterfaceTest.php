<?php

namespace OldApp\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\PhpcrNodeInterface;
use App\Document\PhpcrReferencableInterface;

class PhpcrReferencableInterfaceTest extends TestCase
{
    public function testExtendsPhpcrNodeInterface()
    {
        $referencable = $this->createMock(PhpcrReferencableInterface::class);
        $this->assertInstanceOf(PhpcrNodeInterface::class, $referencable);
    }
}
