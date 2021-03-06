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
        $loader->load('author.xml');
        $loader->load('post.xml');
        $loader->load('paramConverter/post.xml');

        $this->registerParameters($container, $config);
    }

    /**
     * Register container parameters.
     *
     * @param ContainerBuilder $container The container.
     * @param array $config The container's configuration.
     */
    private function registerParameters ( ContainerBuilder $container, array $config )
    {
        // Author
        $container->setParameter('lastdraft.model.author.class', $config['author']['model']);
        $container->setParameter('lastdraft.repository.author.class', $config['author']['repository']);

        // Post
        $container->setParameter('lastdraft.model.post.class', $config['post']['model']);
        $container->setParameter('lastdraft.repository.post.class', $config['post']['repository']);

        // Configuration Classes
        $container->setParameter('lastdraft.config.classes', $config);
    }

}
