<?php

namespace Lastdraft\Bundle\PostBundle\DependencyInjection;

use Doctrine\ORM\Tools\ResolveTargetEntityListener;

use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class DoctrineTargetEntitiesResolver
 *
 * @todo Migrate this to a central location, say CoreBundle?
 * @package Lastdraft\Bundle\PostBundle\DependencyInjection
 */
class DoctrineTargetEntitiesResolver
{

    /**
     * Resolve Doctrine interface entities.
     *
     * @param ContainerBuilder $container
     * @param array $interfaces
     * @throws \RuntimeException
     */
    public function resolve ( ContainerBuilder $container, array $interfaces )
    {
        if ( ! $container->hasDefinition('doctrine.orm.listeners.resolve_target_entity') ) {
            throw new \RuntimeException('Unable to locate Doctrine target entity resolver.');
        }

        $resolveTargetEntityListener = $container->findDefinition('doctrine.orm.listeners.resolve_target_entity');

        foreach ( $interfaces as $interface => $parameter ) {
            if ( ! $container->hasParameter($parameter) ) {
                continue;
            }

            $resolveTargetEntityListener->addMethodCall('addResolveTargetEntity', array(
                $interface, $container->getParameter($parameter), array()
            ));
        }

        $resolveTargetEntityListener->addTag('doctrine.event_listener', array('event' => 'loadClassMetadata'));
    }

}