<?php

namespace Lastdraft\Bundle\PostBundle\DependencyInjection\Compiler;

use Lastdraft\Bundle\PostBundle\Mapper\DoctrineCollector;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class DoctrineMapperPass
 *
 * @todo Migrate to a bundle (CoreBundle, or DoctrineBundle, etc.)
 * @package Lastdraft\Bundle\PostBundle\DependencyInjection\Compiler
 */
class DoctrineMapperPass implements CompilerPassInterface
{

    /**
     * {@inheritdoc}
     */
    public function process ( ContainerBuilder $container )
    {
        if ( !$container->hasDefinition('doctrine') ) {
            $container->removeDefinition('lastdraft.doctrine.mapper');

            return;
        }

        $mapper = $container->getDefinition('lastdraft.doctrine.mapper');

        foreach ( DoctrineCollector::getInstance()->getAssociations() as $class => $associations ) {
            foreach ( $associations as $field => $options ) {
                $mapper->addMethodCall('addAssociation', array($class, $field, $options));
            }
        }

        foreach ( DoctrineCollector::getInstance()->getDiscriminatorColumns() as $class => $columnDefinition ) {
            $mapper->addMethodCall('addDiscriminatorColumn', array($class, $columnDefinition));
        }

        foreach ( DoctrineCollector::getInstance()->getDiscriminators() as $class => $discriminators ) {
            foreach ( $discriminators as $key => $discriminatorClass ) {
                $mapper->addMethodCall('addDiscriminator', array($class, $key, $discriminatorClass));
            }
        }

        foreach ( DoctrineCollector::getInstance()->getInheritanceTypes() as $class => $type ) {
            $mapper->addMethodCall('addInheritanceType', array($class, $type));
        }

        foreach ( DoctrineCollector::getInstance()->getIndexes() as $class => $indexes ) {
            foreach ( $indexes as $field => $options ) {
                $mapper->addMethodCall('addIndex', array($class, $field, $options));
            }
        }
    }

}