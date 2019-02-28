<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Tests\Traits;

use YoYogaBear\Bundle\PhpcrBundle\Model\AccountableInterface;

class AccountableInterfaceTraitTest extends TraitTestBase
{
    protected function createAccountableRootNodeImplementation(string $identifier): AccountableInterface
    {
        // Interfaces used by a root node
        $interfaces = [
            'RootNodeInterface',
            'BranchNodeInterface',
            'LinkNodesInterface',
            'LinkableInterface',
            'AccountableInterface',
        ];

        // Interfaces implemented by a root node
        $implements = [
            'RootNodeInterface',
            'LinkNodesInterface',
            'LinkableInterface',
            'AccountableInterface',
        ];

        // Traits used by a root node
        $traits = [
            'RootNodeInterfaceTrait',
            'ChildNodesInterfaceTrait',
            'LinkNodesInterfaceTrait',
            'LinkableInterfaceTrait',
            'AccountableInterfaceTrait',
        ];

        // Trait constructors needing execution during __construct
        $constructors = [
            'nodeConstruct($identifier)',
            'childNodesConstruct()',
            'linkNodesConstruct()',
        ];

        // __construct arguments
        $constructArgs = [
            'string $identifier',
        ];

        // Load a concrete implementation of a root node
        $accountableClass = $this->loadConcreteImplementation($interfaces, $implements, $traits, $constructors, $constructArgs);

        // Create a new root node
        $accountableNode = new $accountableClass($identifier);

        return $accountableNode;
    }

    public function testCreated()
    {
        $accountableNode = $this->createAccountableRootNodeImplementation('/testPath/testRoot');

        $date = new \DateTime();
        $this->assertEquals($accountableNode, $accountableNode->setCreated($date));
        $this->assertEquals($date, $accountableNode->getCreated());
    }

    public function testCreatedBy()
    {
        $accountableNode = $this->createAccountableRootNodeImplementation('/testPath/testRoot');

        $this->assertEquals($accountableNode, $accountableNode->setCreatedBy('admin'));
        $this->assertEquals('admin', $accountableNode->getCreatedBy());
    }

        public function testLastModified()
        {
            $accountableNode = $this->createAccountableRootNodeImplementation('/testPath/testRoot');

            $date = new \DateTime();
            $this->assertEquals($accountableNode, $accountableNode->setLastModified($date));
            $this->assertEquals($date, $accountableNode->getLastModified());
        }

        public function testLastModifiedBy()
        {
            $accountableNode = $this->createAccountableRootNodeImplementation('/testPath/testRoot');

            $this->assertEquals($accountableNode, $accountableNode->setLastModifiedBy('admin'));
            $this->assertEquals('admin', $accountableNode->getLastModifiedBy());
        }
}
