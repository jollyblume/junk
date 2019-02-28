<?php

namespace OldApp\Initializer;

use App\Document\RootNode;
use App\Document\TreeInterface;
use App\Exception\ExceptionContext;
use App\Exception\TreeNodeMissingException;
use App\Exception\MissingInterfaceException;
use Doctrine\Bundle\PHPCRBundle\Initializer\InitializerInterface;
use Doctrine\Bundle\PHPCRBundle\ManagerRegistry;

class PhpcrInitializer implements InitializerInterface
{
    /**
     * Base path to documents.
     *
     * @var string
     */
    private $basePath;

    /**
     * Array of TreeNode's to create under RootNode.
     *
     * @var array
     */
    private $treeNodes;

    /**
     * Construtor.
     *
     * @param string $basePath
     */
    public function __construct($basePath = '/app')
    {
        $this->basePath = $basePath;
    }

    /**
     * Get the TreeNode array.
     *
     * @return array
     */
    public function getTreeNodes()
    {
        return $this->treeNodes ?? [];
    }

    /**
     * Set the TreeNode array.
     *
     * @param array $treeNodes
     *
     * @return self
     */
    public function setTreeNodes(array $treeNodeClasses)
    {
        foreach ($treeNodeClasses as $treeNodeClass) {
            if (!class_exists($treeNodeClass)) {
                $context = new ExceptionContext(
                    'exception.treenodemissing',
                    'TreeNode class missing'
                );

                throw new TreeNodeMissingException($context);
            }

            $implements = class_implements($treeNodeClass);
            if (!array_key_exists('App\Document\TreeInterface', $implements)) {
                $context = new ExceptionContext(
                    'exception.missinginterface',
                    'Tree Node must implement TreeInterface'
                );

                throw new MissingInterfaceException($context);
            }
        }
        $this->treeNodes = array_unique($treeNodeClasses);

        return $this;
    }

    /**
     * Initialize the application document tree.
     *
     * @param ManagerRegistry $registry Phpcr manager registry
     *
     * @throws MissingInterfaceException Children must implement TreeInterface
     */
    public function init(ManagerRegistry $registry)
    {
        $basePath = $this->basePath;
        $manager = $registry->getManagerForClass(RootNode::class);

        $rootNode = $manager->find(null, $basePath);
        if (!$rootNode) {
            // Initialize the root node
            $rootNode = new RootNode();
            $rootNode->setId($basePath);
            $manager->persist($rootNode);
        }

        $treeNodes = $this->getTreeNodes();
        foreach ($treeNodes as $treeNodeClass) {
            $treeNode = new $treeNodeClass();
            $nodeType = strtolower($treeNode->getNodeType());
            $treeNode->setNodename($nodeType);
            $rootNode->addTreeNode($treeNode);
        }

        $manager->persist($rootNode);
        $manager->flush();
    }

    public function getName()
    {
        return 'else/sandbox Initializer';
    }
}
