<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Phpcr;

use Doctrine\Bundle\PHPCRBundle\Initializer\InitializerInterface;
use Doctrine\Bundle\PHPCRBundle\ManagerRegistry;
use YoYogaBear\Bundle\PhpcrBundle\Registry\Registry as BundleRegistry;
use PHPCR\Util\
{
    NodeHelper,
    PathHelper
};

class YybPhpcrInitializer implements InitializerInterface
{
    /**
     * @var BundleRegistry $bundleRegistry
     */
    private $bundleRegistry;

    public function __construct(BundleRegistry $bundleRegistry)
    {
        $this->bundleRegistry = $bundleRegistry;
    }

    public function getName() {
        return 'YybPhpcrBundle Initializer';
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function init(ManagerRegistry $managerRegistry)
    {
        $bundleRegistry = $this->bundleRegistry;
        $rootNodeDefinitions = $bundleRegistry->getRootNodeDefinitions();
        $documentManager = $managerRegistry->getManager();

        $session = $managerRegistry->getConnection();
        foreach ($rootNodeDefinitions as $definition) {
            $identifier = $definition->getIdentifier();
            $parentPath = PathHelper::getParentPath($identifier);
            NodeHelper::createPath($session, $parentPath);
        }
        if ($session->hasPendingChanges()) {
            $session->save();
        }

        foreach ($rootNodeDefinitions as $definition) {
            $identifier = $definition->getIdentifier();
            $classname = $definition->getClassName();

            $rootNode =
                $documentManager->find(null, $identifier) ??
                new $classname($identifier);
            $documentManager->persist($rootNode);
        }
        $documentManager->flush();
    }
}
