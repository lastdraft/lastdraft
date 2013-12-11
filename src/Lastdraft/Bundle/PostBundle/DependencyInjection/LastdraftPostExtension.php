<?php

namespace Lastdraft\Bundle\PostBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\Config\FileLocator,
    Symfony\Component\HttpKernel\DependencyInjection\Extension,
    Symfony\Component\DependencyInjection\Loader;

/**
 * Class LastdraftPostExtension
 *
 * @package Lastdraft\Bundle\PostBundle\DependencyInjection
 */
class LastdraftPostExtension extends Extension
{

    /**
     * {@inheritDoc}
     */
    public function load ( array $configs, ContainerBuilder $container )
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader( $container, new FileLocator( __DIR__ . '/../Resources/config' ) );
        $loader->load('services.xml');

        // set container parameters based on configuration
        $container->setParameter('lastdraft_post.author.entity', $config['author']['entity']);

        $container->setParameter('lastdraft_post.post.controller', $config['post']['controller']);
        $container->setParameter('lastdraft_post.post.entity', $config['post']['entity']);
    }

}
