<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Tests\DependencyInjection\CompilerPass;

use YoYogaBear\Bundle\PhpcrBundle\DependencyInjection\CompilerPass\
{
    RegistryCompilerPass
};
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\
{
    AbstractCompilerPassTestCase
};
use Symfony\Component\DependencyInjection\
{
    ContainerBuilder,
    Definition
};

class RegistryCompilerPassTest extends AbstractCompilerPassTestCase
{
    protected function registerCompilerPass(ContainerBuilder $container)
    {
        $compilerPass = new RegistryCompilerPass();
        $container->addCompilerPass($compilerPass);
    }

    public function testCompilerPassWithNoRegistryService()
    {
        $this->compile();

        $this->assertContainerBuilderNotHasService('yyb_phpcr');
    }

    public function testCompilerPassWithRegistryService()
    {
        $registryDefinition = $this->registerService('yyb_phpcr', 'YoYogaBear\Bundle\PhpcrBundle\Registry\Registry');
        $this->compile();

        $this->assertContainerBuilderHasService('yyb_phpcr');
        $this->assertEmpty($registryDefinition->getMethodCalls());
    }

    public function testCompilerPassWithRootNodeService()
    {
        $registryDefinition = $this->registerService('yyb_phpcr', 'YoYogaBear\Bundle\PhpcrBundle\Registry\Registry');

        $rootNodeDefinition = $this->registerService('yyb_test.root_node', 'YoYogaBear\Bundle\PhpcrBundle\Registry\RootNodeDefinition()');
        $rootNodeDefinition->setPublic(false);
        $rootNodeDefinition->setArguments([
            '/testPath/testRootNode',
            'YoYogaBear\Bundle\PhpcrBundle\Document\RootNode',
        ]);
        $rootNodeDefinition->addTag('yyb_phpcr.root_node');

        $this->compile();

        $this->assertCount(1, $registryDefinition->getMethodCalls());
    }
}
