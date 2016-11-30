<?php

namespace Ivanche\TypeConverterBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class IvancheTypeConverterExtension extends Extension
{
    const PARAMETER_AUTO_MAPPING = 'ivanche.type_converter_bundle.type_converter.auto_mapping';
    const PARAMETER_STRICT = 'ivanche.type_converter_bundle.type_converter.strict';

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(dirname(__DIR__) . '/Resources/config'));

        $loader->load('services.yml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter(self::PARAMETER_AUTO_MAPPING, $config['auto_mapping']);
        $container->setParameter(self::PARAMETER_STRICT, $config['strict']);
    }
}
