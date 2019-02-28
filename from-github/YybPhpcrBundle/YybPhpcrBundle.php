<?php

namespace YoYogaBear\Bundle\PhpcrBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use YoYogaBear\Bundle\PhpcrBundle\DependencyInjection\CompilerPass\RegistryCompilerPass;

class YybPhpcrBundle extends Bundle
{
    public function build(ContainerBuilder $container) {
        parent::build($container);

        $container->addCompilerPass(new RegistryCompilerPass());
    }
}
