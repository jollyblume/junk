<?php

namespace OldApp\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\LocationNode;
use Doctrine\Common\Collections\ArrayCollection;

class LocationNodeTest extends TestCase
{
    public function testConstructSetsChildren()
    {
        $node = new LocationNode();
        $this->assertInstanceOf(ArrayCollection::class, $node->getChildren());
    }

    public function testGetNodeType()
    {
        $node = new LocationNode();
        $this->assertEquals('Location', $node->getNodeType());
    }
}
