<?php

namespace Lastdraft\Bundle\DoctrineBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\Config\FileLocator,
    Symfony\Component\HttpKernel\DependencyInjection\Extension,
    Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 */
class LastdraftDoctrineExtension extends Extension
{

    /**
     * {@inheritDoc}
     */
    public function load ( array $configs, ContainerBuilder $container )
    {
        $loader = new Loader\XmlFileLoader( $container, new FileLocator( __DIR__ . '/../Resources/config' ) );
        $loader->load('metadataSubscriber.xml');
    }

}
