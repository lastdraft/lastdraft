<?php

namespace Lastdraft\Bundle\DoctrineBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface,
    Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class ResolveDoctrineTargetEntitiesPass
 *
 * @package Lastdraft\Bundle\DoctrineBundle\DependencyInjection\Compiler
 */
class ResolveDoctrineTargetEntitiesPass implements CompilerPassInterface
{

    /**
     * Array of interfaces to resolve to entities.
     *
     * @var array
     */
    private $interfaces;

    /**
     * @param array $interfaces An array of interfaces to resolve.
     */
    public function __construct ( array $interfaces )
    {
        $this->interfaces = $interfaces;
    }

    /**
     * {@inheritdoc}
     */
    public function process ( ContainerBuilder $container )
    {
        if ( ! $container->hasDefinition('doctrine.orm.listeners.resolve_target_entity') ) {
            throw new \RuntimeException('Cannot find Doctrine RTEL.');
        }

        $definition = $container->findDefinition('doctrine.orm.listeners.resolve_target_entity');

        foreach ( $this->interfaces as $interface => $parameter ) {
            if ( ! $container->hasParameter($parameter) ) {
                continue;
            }

            $definition->addMethodCall('addResolveTargetEntity', array(
                $interface, $container->getParameter($parameter), array()
            ));
        }

        if ( ! $definition->hasTag('doctrine.event_listener')) {
            $definition->addTag('doctrine.event_listener', array('event' => 'loadClassMetadata'));
        }
    }

}