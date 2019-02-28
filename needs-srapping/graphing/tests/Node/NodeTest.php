<?php

namespace Jollyblume\Component\Tests\Graphing\Traits;

use Jollyblume\Component\Graphing\Node\Node;

class NodeTest extends \PHPUnit\Framework\TestCase
{
    public function testGetNodename()
    {
        $node = new Node('testNode');
        $this->assertEquals(
            'testNode',
            $node->getNodename(),
            'getNodename() MUST EQUAL constructor argument $nodename'
        );
    }
}
