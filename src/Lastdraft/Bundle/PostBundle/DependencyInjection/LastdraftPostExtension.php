<?php

namespace Lastdraft\Bundle\PostBundle\DependencyInjection;

use Lastdraft\Bundle\PostBundle\Mapper\DoctrineCollector;

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
        $loader->load('mapper.xml');
        $loader->load('post.xml');

        $this->registerDoctrineMapping($config);
        $this->registerParameters($container, $config);
    }

    /**
     * Register Doctrine mappings.
     *
     * @param array $config
     */
    private function registerDoctrineMapping ( array $config )
    {
        $collector = DoctrineCollector::getInstance();

        // one author has many posts
        $collector->addAssociation($config['author']['entity'], 'OneToMany', array(
            'fieldName'    => 'posts',
            'targetEntity' => $config['post']['entity'],
            'mappedBy'     => 'author',
        ));

        // many posts have one author
        $collector->addAssociation($config['post']['entity'], 'ManyToOne', array(
            'fieldName'    => 'author',
            'targetEntity' => $config['author']['entity'],
            'inversedBy'   => 'posts',
            'joinColumns'  => array(
                array(
                    'name'                 => 'author_id',
                    'referencedColumnName' => 'id',
                ),
            ),
        ));
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
        $container->setParameter('lastdraft.entity.author.class', $config['author']['entity']);
        $container->setParameter('lastdraft.repository.author.class', $config['author']['repository']);
        // Post
        $container->setParameter('lastdraft.entity.post.class', $config['post']['entity']);
        $container->setParameter('lastdraft.repository.post.class', $config['post']['repository']);
    }

}
