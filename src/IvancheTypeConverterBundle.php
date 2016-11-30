<?php

namespace Ivanche\TypeConverterBundle;

use Ivanche\TypeConverterBundle\DependencyInjection\Compiler\AddConvertersByTagPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class IvancheTypeConverterBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new AddConvertersByTagPass());
    }
}
