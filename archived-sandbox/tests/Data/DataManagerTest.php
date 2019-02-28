<?php

namespace App\Tests\Data;

use PHPUnit\Framework\TestCase;
use App\Data\DataManager;

class DataManagerTest extends TestCase
{
    public function testGetRegistry()
    {
        $registry = $this->createMock('\Doctrine\Bundle\PHPCRBundle\ManagerRegistry');
        $dataManager = new DataManager($registry, '/notabase');
        $this->assertEquals($registry, $dataManager->getRegistry());
    }

    public function testGetBasePath()
    {
        $registry = $this->createMock('\Doctrine\Bundle\PHPCRBundle\ManagerRegistry');
        $dataManager = new DataManager($registry, '/notabase');
        $this->assertEquals('/notabase', $dataManager->getBasePath());
    }
}
