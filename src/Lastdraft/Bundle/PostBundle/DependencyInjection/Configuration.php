<?php

namespace Lastdraft\Bundle\PostBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('lastdraft_post');

        $rootNode
            ->addDefaultsIfNotSet()
            ->info('Lastdraft Post Configuration')
        ;

        // class configuration
        $this->addClassSection($rootNode);

        return $treeBuilder;
    }

    /**
     * Add the class section configuration settings.
     *
     * @param ArrayNodeDefinition $rootNode The root configuration node.
     */
    public function addClassSection ( ArrayNodeDefinition $rootNode )
    {
        $rootNode
            ->children()
                ->arrayNode('author')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('entity')
                            ->cannotBeEmpty()
                            ->example('Lastdraft\\Bundle\\PostBundle\\Entity\\Author')
                            ->info('Post Entity Class')
                            ->defaultValue('Lastdraft\\Bundle\\PostBundle\\Entity\\Author')
                        ->end()

                        ->scalarNode('repository')
                            ->cannotBeEmpty()
                            ->example('Lastdraft\\Bundle\\PostBundle\\Repository\\AuthorRepository')
                            ->info('Post Repository Class')
                            ->defaultValue('Lastdraft\\Bundle\\PostBundle\\Repository\\AuthorRepository')
                        ->end()
                    ->end()
                ->end()

                ->arrayNode('post')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('entity')
                            ->cannotBeEmpty()
                            ->example('Lastdraft\\Bundle\\PostBundle\\Entity\\Post')
                            ->info('Post Entity Class')
                            ->defaultValue('Lastdraft\\Bundle\\PostBundle\\Entity\\Post')
                        ->end()

                        ->scalarNode('repository')
                            ->cannotBeEmpty()
                            ->example('Lastdraft\\Bundle\\PostBundle\\Repository\\PostRepository')
                            ->info('Post Repository Class')
                            ->defaultValue('Lastdraft\\Bundle\\PostBundle\\Repository\\PostRepository')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

}
