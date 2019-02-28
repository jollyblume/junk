<?php

namespace YoYogaBear\Bundle\PhpcrBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class RegistryCompilerPass implements CompilerPassInterface
{
    /**
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->has('yyb_phpcr')) {
            $registryDefinition = $container->findDefinition('yyb_phpcr');
            $taggedRootNodes = $container->findTaggedServiceIds('yyb_phpcr.root_node');

            foreach ($taggedRootNodes as $rootNodeId => $rootNodetags) {
                foreach ($rootNodetags as $rootNodetag) {
                    $registryDefinition->addMethodCall(
                            'addRootNodeDefinition',
                            [new Reference($rootNodeId), $rootNodeId]
                    );
                }
            }
        }
    }
}
