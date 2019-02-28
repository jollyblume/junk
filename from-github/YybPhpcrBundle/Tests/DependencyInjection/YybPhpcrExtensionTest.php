<?php

namespace YoYogaBear\Bundle\PhpcrBundle\Tests\DependencyInjection;

use YoYogaBear\Bundle\PhpcrBundle\DependencyInjection\
{
    YybPhpcrExtension
};
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\
{
    AbstractExtensionTestCase
};

class YybPhpcrExtensionTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions()
    {
        return [
            new YybPhpcrExtension(),
        ];
    }

    public function testRegistryNameParameterSet()
    {
        $this->load();
        $this->assertContainerBuilderHasParameter('registry_id');
        $this->assertNotEquals('REGISTRY_NOT_CONFIGURED', $this->container->getParameter('registry_id'));
    }

    public function testRegistryExists()
    {
        $this->load();
        $this->assertContainerBuilderHasService('yyb_phpcr');
    }
}
