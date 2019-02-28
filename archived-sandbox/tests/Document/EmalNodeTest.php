<?php

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\EmailNode;
use Doctrine\Common\Collections\ArrayCollection;

class EmailNodeTest extends TestCase
{
    public function testConstructSetsChildren()
    {
        $node = new EmailNode();
        $this->assertInstanceOf(ArrayCollection::class, $node->getChildren());
    }

    public function testGetNodeType()
    {
        $node = new EmailNode();
        $this->assertEquals('Email', $node->getNodeType());
    }
}
