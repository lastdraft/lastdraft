<?php

namespace Lastdraft\Bundle\PostBundle\DependencyInjection\Compiler;

use Lastdraft\Bundle\PostBundle\DependencyInjection\DoctrineTargetEntitiesResolver;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
    Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class ResolveDoctrineTargetEntitiesPass
 *
 * @todo Migrate this to a central location, say CoreBundle?
 * @package Lastdraft\Bundle\PostBundle\DependencyInjection\Compiler
 */
class ResolveDoctrineTargetEntitiesPass implements CompilerPassInterface
{

    /**
     * An array of interfaces.
     *
     * @var array
     */
    private $interfaces;

    /**
     * The bundle's prefix.
     *
     * @var string
     */
    private $bundlePrefix;

    /**
     * Define the bundle's prefixes and interfaces.
     *
     * @param string $bundlePrefix The bundle's prefix.
     * @param array $interfaces    An array of interfaces used.
     */
    public function __construct ( $bundlePrefix, array $interfaces )
    {
        $this->bundlePrefix = $bundlePrefix;
        $this->interfaces   = $interfaces;
    }

    /**
     * {@inheritdoc}
     */
    public function process ( ContainerBuilder $container )
    {
        $resolver = new DoctrineTargetEntitiesResolver();
        $resolver->resolve($container, $this->interfaces);
    }

}


