<?php

namespace Lastdraft\Bundle\DoctrineBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

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
     * The bundle's prefix.
     *
     * @var string
     */
    private $prefix;

    /**
     * @param string $prefix The bundle's prefix.
     * @param array $interfaces An array of interfaces to resolve.
     */
    public function __construct ( $prefix, array $interfaces )
    {
        $this->prefix = $prefix;
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

            $evm  = new \Doctrine\Common\EventManager;

            $definition->addMethodCall('addResolveTargetEntity', array(
                $interface, $container->getParameter($parameter), array()
            ));

            $evm->addEventListener(\Doctrine\ORM\Events::loadClassMetadata, $definition);
        }

        if ( ! $definition->hasTag('doctrine.event_listener')) {
            $definition->addTag('doctrine.event_listener', array('event' => 'loadClassMetadata'));
        }
    }

}