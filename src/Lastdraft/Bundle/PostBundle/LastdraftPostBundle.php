<?php

namespace Lastdraft\Bundle\PostBundle;

use Lastdraft\Bundle\PostBundle\DependencyInjection\Compiler\DoctrineMapperPass;
use Symfony\Component\HttpKernel\Bundle\Bundle,
    Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class LastdraftPostBundle
 *
 * @package Lastdraft\Bundle\PostBundle
 */
class LastdraftPostBundle extends Bundle
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
