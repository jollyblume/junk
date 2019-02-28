<?php

namespace OldApp\Data;

use Doctrine\Bundle\PHPCRBundle\ManagerRegistry;
use Doctrine\ODM\PHPCR\DocumentManager;
use App\Document\RootNode;
use App\Document\PhpcrNodeInterface;
use App\Exception\ExceptionContext;
use App\Exception\RootNodeMissingException;

/**
 * DataManager.
 *
 * Interface to Phpcr
 */
class DataManager
{
    /**
     * Phpcr Manager Registry.
     *
     * @var ManagerRegistry
     */
    private $registry;

    /**
     * Phpcr Document Manager.
     *
     * @var ManagerRegistry
     */
    private $manager;

    /**
     * RootNode.
     *
     * @var RootNode
     */
    private $rootNode;

    /**
     * Base path.
     *
     * @var string
     */
    private $basePath;

    public function __construct(ManagerRegistry $registry, string $basePath)
    {
        $this->registry = $registry;
        $this->basePath = $basePath;
    }

    /**
     * Get the Phpcr Manager Registry.
     *
     * @return ManagerRegistry
     */
    public function getRegistry()
    {
        return $this->registry;
    }

    /**
     * Get the Phpcr Base Path.
     *
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * Get the Phpcr Document Manager.
     *
     * @return DocumentManager
     */
    public function getManager()
    {
        $manager = $this->manager;
        if (null === $manager) {
            $registry = $this->getRegistry();
            $manager = $registry->getManagerForClass(RootNode::class);
            $this->manager = $manager;
        }

        return $manager;
    }

    /**
     * Get the Phpcr RootNode.
     *
     * @return RootNode
     */
    public function getRootNode()
    {
        $rootNode = $this->rootNode;
        if (null === $rootNode) {
            $rootNode = $this->find($this->getBasePath());
            $this->rootNode = $rootNode;
        }
        if (null === $rootNode) {
            $context = new ExceptionContext(
                'exception.rootnodemissing',
                'RootNode is missing bin/console do:ph:re:in'
            );

            throw new RootNodeMissingException($context);
        }

        return $rootNode;
    }

    /**
     * Find a Phpcr Node by Path or Uuid.
     *
     * @param string $pathOrUuid
     *
     * @return PhpcrNodeInterface
     */
    public function find(string $pathOrUuid)
    {
        $manager = $this->getManager();

        return $manager->find(null, $pathOrUuid);
    }

    /**
     * Persist a Phpcr Node to the database.
     */
    public function persist(?PhpcrNodeInterface $node = null)
    {
        $nodeToPersist = $node->getParent() ?? $this->getRootNode();
        $manager = $this->getManager();
        $manager->persist($nodeToPersist);
    }

    /**
     * Flush changes to the database.
     */
    public function flush()
    {
        $manager = $this->getManager();
        $manager->flush();
    }
}
