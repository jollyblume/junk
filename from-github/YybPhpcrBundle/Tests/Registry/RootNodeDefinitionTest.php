<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Tests\Traits;

use YoYogaBear\Bundle\PhpcrBundle\Registry\
{
    RootNodeDefinition
};
use YoYogaBear\Bundle\PhpcrBundle\Exception\
{
    YybPhpcrException
};
use PHPUnit\Framework\
{
    TestCase
};

class RootNodeDefinitionTest extends TestCase
{
    public function testConstructBadClass()
    {
        try {
            new RootNodeDefinition('/testPath/testRootNode', 'YoYogaBear\Bundle\PhpcrBundle\Document\Node');
            $this->fail();
        } catch (YybPhpcrException $ex) {
            $this->assertTrue(true);
        }
    }

    public function testConstructMissingClass()
    {
        try {
            new RootNodeDefinition('/testPath/testRootNode', 'notaclass');
            $this->fail();
        } catch (\ReflectionException $ex) {
            $this->assertTrue(true);
        }
    }

    public function testGetIdentifier()
    {
        $definition = new RootNodeDefinition('/testPath/testRootNode', 'YoYogaBear\Bundle\PhpcrBundle\Document\RootNode');

        $this->assertEquals('/testPath/testRootNode', $definition->getIdentifier());
    }

    public function testGetClassName()
    {
        $definition = new RootNodeDefinition('/testPath/testRootNode', 'YoYogaBear\Bundle\PhpcrBundle\Document\RootNode');

        $this->assertEquals('YoYogaBear\Bundle\PhpcrBundle\Document\RootNode', $definition->getClassName());
    }
}
