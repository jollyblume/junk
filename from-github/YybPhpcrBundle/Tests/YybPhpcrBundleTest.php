<?php

namespace YoYogoBear\Bundle\PhpcrBundle\Tests;

use YoYogaBear\Bundle\PhpcrBundle\
{
    YybPhpcrBundle
};
use Symfony\Component\DependencyInjection\
{
    ContainerBuilder
};
use PHPUnit\Framework\
{
    TestCase
};

class YybPhpcrBundleTest extends TestCase
{
    public function testBuild()
    {
        $container = new ContainerBuilder();
        $bundle = new YybPhpcrBundle();
        $bundle->build($container);

        $compilerPass = $container->getCompilerPassConfig()->getBeforeOptimizationPasses()[0];
        $this->assertInstanceOf('YoYogaBear\Bundle\PhpcrBundle\DependencyInjection\CompilerPass\RegistryCompilerPass', $compilerPass);
    }
}
