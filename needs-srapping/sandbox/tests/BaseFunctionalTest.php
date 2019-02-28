<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\Bundle\PHPCRBundle\ManagerRegistry;
use Doctrine\ODM\PHPCR\DocumentManager;
use App\Document\RootNode;
use App\Model\NodeInterface;
use App\Initializer\PhpcrInitializer;
use App\Exception\ExceptionContext;
use App\Exception\UnexpectedNullException;
use PHPCR\Util\UUIDHelper;

abstract class BaseFunctionalTest extends WebTestCase
{
    const BASE_PATH = '/app_test';

    public static function setUpBeforeClass()
    {
        self::bootKernel();
    }

    public static function tearDownAfterClass()
    {
        static::ensureKernelShutdown();
    }

    /**
     * @var ManagerRegistry
     */
    private $registry;

    public function setup()
    {
        // $this->registry = null;
    }

    protected function tearDown()
    {
    }

    protected function getBasePath()
    {
        return self::BASE_PATH;
    }

    protected function getFullPath(string $path)
    {
        if ('' === $path || '/' === $path) {
            return $this->getBasePath();
        }

        $fullPath = sprintf('%s/%s', self::BASE_PATH, $path);

        return $fullPath;
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    protected function isUuid($identifier)
    {
        return UUIDHelper::isUUID($identifier);
    }

    /**
     * @return ManagerRegistry
     */
    protected function getRegistry()
    {
        $registry = $this->registry;
        if (null === $registry) {
            $kernel = static::$kernel;
            $registry = $kernel->getContainer()->get('doctrine_phpcr');
            $this->registry = $registry;
        }

        return $registry;
    }

    /**
     * @return DocumentManager
     */
    protected function getManager()
    {
        $registry = $this->getRegistry();
        $manager = $registry->getManagerForClass(RootNode::class);

        return $manager;
    }

    /**
     * @return PhpcrInitializer
     */
    protected function getPhpcrInitializer(array $treeNodeClasses = [])
    {
        $initializer = new PhpcrInitializer($this->getBasePath());
        $initializer->setTreeNodes($treeNodeClasses);

        return $initializer;
    }

    public function getTreeNodeData()
    {
        $treeNodeData = [
            '\App\Document\CalendarBag' => '\App\Document\CalendarNode',
            '\App\Document\EmailBag' => '\App\Document\EmailNode',
            '\App\Document\LeagueBag' => '\App\Document\LeagueNode',
            '\App\Document\LocationBag' => '\App\Document\LocationNode',
            '\App\Document\PlayerBag' => '\App\Document\PlayerNode',
            '\App\Document\TeamBag' => '\App\Document\TeamNode',
            '\App\Document\TournamentBag' => '\App\Document\TournamentNode',
        ];

        return $treeNodeData;
    }

    protected function getTreeNodes()
    {
        $treeNodeData = $this->getTreeNodeData();

        return array_keys($treeNodeData);
    }

    protected function getDocumentNodes()
    {
        $treeNodeData = $this->getTreeNodeData();

        return array_values($treeNodeData);
    }

    protected function findTestNode(string $pathOrUuid = '')
    {
        if (!$this->isUuid($pathOrUuid)) {
            $pathOrUuid = $this->getFullPath($pathOrUuid);
        }
        $manager = $this->getManager();
        $node = $manager->find(null, $pathOrUuid);

        return $node;
    }

    /**
     * @return RootNode
     */
    protected function findTestRootNode()
    {
        return $this->findTestNode();
    }

    protected function resetTestRootNode(array $treeClasses = [])
    {
        $this->removeTestRootNode();

        $registry = $this->getRegistry();
        $initializer = $this->getPhpcrInitializer($treeClasses);
        $initializer->init($registry);
    }

    protected function resetTestRootNodeToDefaults()
    {
        $treeClasses = $this->getTreeNodes();
        $this->resetTestRootNode($treeClasses);
    }

    protected function removeTestNode($nodeOrPath = '')
    {
        if (null === $nodeOrPath) {
            $context = new ExceptionContext(
                'exception.unexpectednull',
                'Null passed to removeTestNode'
            );
            throw new UnexpectedNullException($context);
        }

        if (is_string($nodeOrPath)) {
            $node = $this->findTestNode($nodeOrPath);
            $nodeOrPath = $node;
        }

        if (null === $nodeOrPath) {
            return;
        }

        $manager = $this->getManager();
        $manager->remove($nodeOrPath);
        $manager->flush();
    }

    protected function removeTestRootNode()
    {
        $this->removeTestNode();
    }

    protected function persistTestNode(?NodeInterface $testNode = null)
    {
        if (null === $testNode) {
            $testNode = $this->findTestRootNode();
        }
        $manager = $this->getManager();
        $manager->persist($testNode);
        // $manager->flush($testNode);
    }

    protected function flushTestNode()
    {
        $rootNode = $this->findTestRootNode();
        $manager = $this->getManager();
        $manager->flush($rootNode);
    }
}
