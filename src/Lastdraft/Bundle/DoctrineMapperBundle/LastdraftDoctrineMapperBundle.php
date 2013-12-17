<?php

namespace Lastdraft\Bundle\DoctrineMapperBundle;

use Lastdraft\Bundle\DoctrineMapperBundle\DependencyInjection\Compiler\DoctrineMapperPass;

use Symfony\Component\HttpKernel\Bundle\Bundle,
    Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class LastdraftDoctrineMapperBundle
 *
 * @package Lastdraft\Bundle\DoctrineMapperBundle
 */
class LastdraftDoctrineMapperBundle extends Bundle
{

    /**
     * {@inheritdoc}
     */
    public function build ( ContainerBuilder $container )
    {
        parent::build($container);

        $container->addCompilerPass(new DoctrineMapperPass());
    }

}
