<?php

namespace Lastdraft\Bundle\DoctrineBundle\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Symfony\Component\DependencyInjection\ContainerBuilder;

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
     * @param ContainerBuilder $container
     */
    public function build ( ContainerBuilder $container )
    {

    }

    /**
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata ( LoadClassMetadataEventArgs $eventArgs )
    {
        $metadata = $eventArgs->getClassMetadata();
        $configuration = $eventArgs->getEntityManager()->getConfiguration();

        var_dump('wee');
    }

}