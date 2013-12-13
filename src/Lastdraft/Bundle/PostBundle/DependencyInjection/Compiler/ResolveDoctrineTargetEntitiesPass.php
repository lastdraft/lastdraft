<?php

namespace Lastdraft\Bundle\PostBundle\DependencyInjection\Compiler;

// use Lastdraft\Bundle\PostBundle\DependencyInjection\DoctrineTargetEntitiesResolver;

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
        if ( ! $container->hasDefinition('doctrine.orm.listeners.resolve_target_entity') ) {
            throw new \RuntimeException('Unable to locate Doctrine target entity resolver.');
        }

        $resolveTargetEntityListener = $container->findDefinition('doctrine.orm.listeners.resolve_target_entity');

        foreach ( $this->interfaces as $interface => $parameter ) {
            if ( ! $container->hasParameter($parameter) ) {
                continue;
            }

            /*
            print_r(array(
                'interface: ' => $interface,
                'param:     ' => $parameter,
                'cParam:    ' => $container->getParameter($parameter),
            ));
            */

            $resolveTargetEntityListener->addMethodCall('addResolveTargetEntity', array(
                $interface, $container->getParameter($parameter), array()
            ));
        }

        // var_dump($resolveTargetEntityListener->getMethodCalls());

        $resolveTargetEntityListener->addTag('doctrine.event_listener', array('event' => 'loadClassMetadata'));
    }

}


