<?php

namespace YoYogaBear\Bundle\PhpcrBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\
{
    ContainerBuilder,
    Loader
};
use Symfony\Component\Config\
{
    FileLocator
};
use Symfony\Component\HttpKernel\DependencyInjection\
{
    Extension
};

class YybPhpcrExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('phpcr.yml');

        $registryName = array_key_exists('registry_id', $config) ?
            $config['registry_id'] :
            'REGISTRY_NOT_CONFIGURED'
        ;
        $container->setParameter('registry_id',$registryName);
    }
}
