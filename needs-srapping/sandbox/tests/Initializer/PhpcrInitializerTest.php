<?php

namespace App\Tests\Initializer;

use PHPUnit\Framework\TestCase;
use App\Initializer\PhpcrInitializer;

class PhpcrInitializerTest extends TestCase {
    public function testGetName() {
        $initializer = new PhpcrInitializer('test_path');
        $this->assertEquals('else/sandbox Initializer', $initializer->getName());
    }

    public function testGetTreeNodes() {
        $initializer = new PhpcrInitializer('test_path');

        $treeNodes = [
            'App\Document\PlayerBag',
            'App\Document\TeamBag',
        ];

        $initializer->setTreeNodes($treeNodes);
        $this->assertEquals($treeNodes, $initializer->getTreeNodes());
    }

    /** @expectedException    App\Exception\TreeNodeMissingException */
    public function testSetTreeNodesThrowsIfClassNotExists() {
        $initializer = new PhpcrInitializer('test_path');

        $treeNodes = [
            'App\Document\NotAClass',
        ];

        $initializer->setTreeNodes($treeNodes);
    }
}
