<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Tests\Phpcr;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Bundle\PHPCRBundle\ManagerRegistry;
use PHPCR\Util\NodeHelper;
use YoYogaBear\Bundle\PhpcrBundle\Phpcr\YybPhpcrInitializer;
use YoYogaBear\Bundle\PhpcrBundle\Registry\Registry;

class YybPhpcrInitializerKernelTest extends KernelTestCase
{
    /**
     * @var ContainerInterface $container
     */
    private $container;

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    protected function setUp()
    {
        self::bootKernel();
        $container = static::$kernel->getContainer();
        $this->container = $container;

        $managerRegistry = $container->get('doctrine_phpcr');
        $session = $managerRegistry->getConnection();
        NodeHelper::purgeWorkspace($session);
        $session->save();
    }

    public function testGetName()
    {
        $bundleRegistry = new Registry();
        $initializer = new YybPhpcrInitializer($bundleRegistry);

        $this->assertEquals('YybPhpcrBundle Initializer', $initializer->getName());
    }

    protected function getMockWorkspace(Registry $bundleRegistry = null): ManagerRegistry
    {
        $container = $this->container;

        if (null === $bundleRegistry) {
            $bundleRegistry = $container->get('yyb_phpcr');
        }

        $managerRegistry = $container->get('doctrine_phpcr');

        $initializer = new YybPhpcrInitializer($bundleRegistry);
        $initializer->init($managerRegistry);

        return $managerRegistry;
    }

    public function testInitializerWithEmptyRegistry()
    {
        $bundleRegistry = new Registry();
        $managerRegistry = $this->getMockWorkspace($bundleRegistry);

        $documentManager = $managerRegistry->getManager();
        $phpcrRoot = $documentManager->find('', '/');

        $this->assertCount(0, $phpcrRoot->getChildren());
    }

    public function testInitializerWithTestRegistry()
    {
        $container = $this->container;

        $bundleRegistry = $container->get('yyb_phpcr');
        $managerRegistry = $this->getMockWorkspace($bundleRegistry);
        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Registry\Registry', $bundleRegistry);
        $this->assertArrayHasKey('yyb_rootnode', $bundleRegistry->getRootNodeDefinitions());

        $documentManager = $managerRegistry->getManager();
        $rootNode = $documentManager->find(null, '/testPath/testRootNode');

        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\Document\RootNode', $rootNode);
    }

    public function testInitializerWithTestRegistryNoOverwrite()
    {
        $managerRegistry = $this->getMockWorkspace();
        $documentManager = $managerRegistry->getManager();
        $documentManager->clear();
        $rootNode = $documentManager->find(null, '/testPath/testRootNode');
        $this->assertNotNull($rootNode);
        $uuid = $rootNode->getUuid();

        $managerRegistry = $this->getMockWorkspace();
        $documentManager->clear();
        $rootNode = $documentManager->find(null, '/testPath/testRootNode');
        $this->assertNotNull($rootNode);
        $this->assertEquals($uuid, $rootNode->getUuid());
    }
}
