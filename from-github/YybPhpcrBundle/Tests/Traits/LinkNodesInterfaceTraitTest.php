<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Tests\Traits;

class LinkNodesInterfaceTraitTest extends TraitTestBase
{
    public function testCollectionInitialized()
    {
        $rootNode = $this->getRootNodeImplementation('/testPath/testRoot');

        $this->assertInstanceOf('Doctrine\Common\Collections\ArrayCollection', $rootNode->getLinkNodes());
    }
}
