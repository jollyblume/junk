<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Tests\Traits;

class LinkableInterfaceTraitTest extends TraitTestBase
{
    public function testGetUuidTypeError()
    {
        $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');

        try {
            $rootNode->getUuid();
            $this->fail();
        } catch (\TypeError $ex) {
            $this->assertTrue(true);
        }
    }
}
