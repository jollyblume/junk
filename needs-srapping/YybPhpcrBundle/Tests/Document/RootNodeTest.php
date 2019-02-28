<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Tests\Document;

use YoYogaBear\Bundle\PhpcrBundle\Document\
{
    RootNode
};

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class RootNodeTest extends \PHPUnit\Framework\TestCase
{
    public function testInterfaces()
    {
        $rootNode = new RootNode('/testRootNode');

        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\NodeInterface', $rootNode);
        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\BranchNodeInterface', $rootNode);
        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\RootNodeInterface', $rootNode);
        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\ChildNodesInterface', $rootNode);
        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\LinkNodesInterface', $rootNode);
        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\LinkableInterface', $rootNode);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\ArcNodeInterface', $rootNode);
        $this->assertNotInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Model\AccountableInterface', $rootNode);
    }

    public function testTraits()
    {
        $rootNode = new RootNode('/testRootNode');
        $reflectionClass = new \reflectionClass($rootNode);
        $traitNames = $reflectionClass->getTraitNames();

        $this->assertCount(4, $traitNames);
        $this->assertContains('YoYogaBear\Bundle\PhpcrBundle\Traits\RootNodeInterfaceTrait', $traitNames, implode(', ', $traitNames));
        $this->assertContains('YoYogaBear\Bundle\PhpcrBundle\Traits\ChildNodesInterfaceTrait', $traitNames, implode(', ', $traitNames));
        $this->assertContains('YoYogaBear\Bundle\PhpcrBundle\Traits\LinkNodesInterfaceTrait', $traitNames, implode(', ', $traitNames));
        $this->assertContains('YoYogaBear\Bundle\PhpcrBundle\Traits\LinkableInterfaceTrait', $traitNames, implode(', ', $traitNames));
    }
}
