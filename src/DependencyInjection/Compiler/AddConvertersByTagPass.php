<?php
/**
 * @author IvanChe <ivanche.freelancer@gmail.com>
 */

namespace Ivanche\TypeConverterBundle\DependencyInjection\Compiler;


use Ivanche\Converter\AutoMappingInterface;
use Ivanche\Converter\ConverterInterface;
use Ivanche\TypeConverterBundle\DependencyInjection\IvancheTypeConverterExtension;
use Ivanche\TypeConverterBundle\Exception\UnsupportedConverterException;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class AddConvertersByTagPass implements CompilerPassInterface
{
    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('ivanche.type_converter_bundle.type_converter')) {
            return;
        }

        $definition = $container->findDefinition('ivanche.type_converter_bundle.type_converter');

        /** @var Definition[] $taggedServices */
        $taggedServices = $container->findTaggedServiceIds('ivanche.type_converter_bundle.converter');

        $autoMapping = $container->getParameter(IvancheTypeConverterExtension::PARAMETER_AUTO_MAPPING);
        $strictMode = $container->getParameter(IvancheTypeConverterExtension::PARAMETER_STRICT);
        foreach ($taggedServices as $id => $service) {
            $converter = $container->getDefinition($id);

            $intefaces = class_implements($converter->getClass());
            if (!key_exists(ConverterInterface::class, $intefaces)) {
                throw new UnsupportedConverterException();
            }

            if (key_exists(AutoMappingInterface::class, $intefaces)) {
                $converter->addMethodCall('setAutoMapping', [$autoMapping]);
                $converter->addMethodCall('setStrictMode', [$strictMode]);
            }

            $definition->addMethodCall('registerConverter', [$converter]);
        }
    }
}