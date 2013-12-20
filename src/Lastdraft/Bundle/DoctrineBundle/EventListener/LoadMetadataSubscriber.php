<?php

namespace Lastdraft\Bundle\DoctrineBundle\EventListener;

use Doctrine\Common\EventSubscriber,
    Doctrine\ORM\Event\LoadClassMetadataEventArgs,
    Doctrine\ORM\Mapping\ClassMetadata,
    Doctrine\ORM\Mapping\ClassMetadataInfo;

class LoadMetadataSubscriber implements EventSubscriber
{

    /**
     * An array of classes to work with.
     *
     * @var array
     */
    protected $classes;

    /**
     * Initialize the classes to work with.
     *
     * @param array $classes
     */
    public function __construct ( array $classes )
    {
        $this->classes = $classes;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents ()
    {
        return array('loadClassMetadata');
    }

    /**
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata ( LoadClassMetadataEventArgs $eventArgs )
    {
        $metadata = $eventArgs->getClassMetadata();
        $configuration = $eventArgs->getEntityManager()->getConfiguration();

        foreach ( $this->classes as $class ) {
            if ( array_key_exists('model', $class) && $class['model'] === $metadata->getName() ) {
                $metadata->isMappedSuperclass = false;
            }
        }

        if ( ! $metadata->isMappedSuperclass ) {
            foreach ( class_parents($metadata->getName()) as $parent ) {
                $parentMetadata = new ClassMetadata($parent, $configuration->getNamingStrategy());

                if ( in_array($parent, $configuration->getMetadataDriverImpl()->getAllClassNames()) ) {
                    $configuration->getMetadataDriverImpl()->loadMetadataForClass($parent, $parentMetadata);

                    if ( $parentMetadata->isMappedSuperclass ) {
                        foreach ( $parentMetadata->getAssociationMappings() as $key => $value ) {
                            if ( ClassMetadataInfo::ONE_TO_MANY === $value['type'] || ClassMetadataInfo::ONE_TO_ONE === $value['type'] ) {
                                $metadata->associationMappings[$key] = $value;
                            }
                        }
                    }
                }
            }
        } else {
            foreach ( $metadata->getAssociationMappings() as $key => $value ) {
                if ( $value['type'] === ClassMetadataInfo::ONE_TO_MANY || $value['type'] === ClassMetadataInfo::ONE_TO_ONE ) {
                    unset($metadata->associationMappings[$key]);
                }
            }
        }
    }

}