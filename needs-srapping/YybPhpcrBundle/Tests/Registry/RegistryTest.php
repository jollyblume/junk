<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Tests\Traits;

use YoYogaBear\Bundle\PhpcrBundle\Registry\
{
    Registry,
    RootNodeDefinition
};
use PHPUnit\Framework\
{
    TestCase
};

class RegistryTest extends TestCase
{
    public function testCollectionInitialized()
    {
        $registry = new Registry();

        $this->assertInstanceOf('Doctrine\Common\Collections\ArrayCollection', $registry->getRootNodeDefinitions());
    }

    public function testAddRootNodeDefinition()
    {
        $registry = new Registry();
        $definition = new RootNodeDefinition('/testPath/testRootNode', 'YoYogaBear\Bundle\PhpcrBundle\Document\RootNode');

        $this->assertEquals($registry, $registry->addRootNodeDefinition($definition, 'yyb_test.root_node'));
        $this->assertTrue($registry->getRootNodeDefinitions()->containsKey('yyb_test.root_node'));
    }
}
