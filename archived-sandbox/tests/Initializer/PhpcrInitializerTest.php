<?php

namespace App\Tests\Initializer;

use PHPUnit\Framework\TestCase;
use App\Initializer\PhpcrInitializer;
use App\Document\RootNode;

class PhpcrInitializerTest extends TestCase
{
    const BASE_PATH = '/app_test';
    const NAME = 'else/sandbox Initializer';

    public function testGetName()
    {
        $initializer = new PhpcrInitializer(self::BASE_PATH);
        $this->assertEquals(self::NAME, $initializer->getName());
    }

    public function testGetTreeNodes()
    {
        $initializer = new PhpcrInitializer(self::BASE_PATH);
        $this->assertEquals([], $initializer->getTreeNodes());
    }

    public function testSetTreeNodes()
    {
        $initializer = new PhpcrInitializer(self::BASE_PATH);
        $treeNodes = [
            'treeOne' => '\App\Document\PlayerTree',
        ];
        $initializer->setTreeNodes($treeNodes);
        $playerTreeClass = $initializer->getTreeNodes()['treeOne'];
        $this->assertEquals('\App\Document\PlayerTree', $playerTreeClass);
    }

    /**
     * @expectedException       \App\Exception\TreeNodeMissingException
     */
    public function testSetTreeNodesThrowsIfClassMissing()
    {
        $initializer = new PhpcrInitializer(self::BASE_PATH);
        $treeNodes = [
            'treeOne' => 'notaclass',
        ];
        $initializer->setTreeNodes($treeNodes);
    }

    /**
     * @expectedException       \App\Exception\MissingInterfaceException
     */
    public function testSetTreeNodesThrowsIfNotImplementTreeInterface()
    {
        $initializer = new PhpcrInitializer(self::BASE_PATH);
        $treeNodes = [
            'treeOne' => '\App\Document\PlayerBag',
        ];
        $initializer->setTreeNodes($treeNodes);
    }
}
