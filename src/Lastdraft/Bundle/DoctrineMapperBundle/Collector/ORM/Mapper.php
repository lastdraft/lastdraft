<?php

namespace Lastdraft\Bundle\DoctrineMapperBundle\Collector\ORM;

use Doctrine\Bundle\DoctrineBundle\Registry,
    Doctrine\Common\EventSubscriber,
    Doctrine\Common\Persistence\Event\LoadClassMetadataEventArgs,
    Doctrine\Common\Persistence\Mapping\ClassMetadata;

/**
 * Class Mapper
 *
 * @package Lastdraft\Bundle\DoctrineMapperBundle\Collector\ORM
 */
class Mapper implements EventSubscriber
{

    /**
     * An array of associations.
     *
     * @var array
     */
    protected $associations = array();

    /**
     * An array of discriminator columns.
     *
     * @var array
     */
    protected $discriminatorColumns = array();

    /**
     * An array of discriminators.
     *
     * @var array
     */
    protected $discriminators = array();

    /**
     * @var \Doctrine\Bundle\DoctrineBundle\Registry
     */
    protected $doctrine;

    /**
     * An array of indexes.
     *
     * @var array
     */
    protected $indexes = array();

    /**
     * An array of inheritance types.
     *
     * @var array
     */
    protected $inheritanceTypes = array();

    /**
     * Constructor.
     *
     * @param Registry $doctrine
     */
    public function __construct( Registry $doctrine )
    {
        $this->doctrine = $doctrine;
    }

    /**
     * Add an association to the Doctrine mapping.
     *
     * @param string $class The fully qualified class name.
     * @param string $field The name of the field.
     * @param array $options The association options.
     */
    public function addAssociation ( $class, $field, array $options )
    {
        if ( ! isset($this->associations[$class]) ) {
            $this->associations[$class] = array();
        }

        $this->associations[$class][$field] = $options;
    }

    /**
     * Add a discriminator to the Doctrine mapping.
     *
     * @param string $class The fully qualified class name.
     * @param string $key The discriminator key.
     * @param string $discriminatorClass The mapped class.
     */
    public function addDiscriminator ( $class, $key, $discriminatorClass )
    {
        if ( ! isset($this->discriminators[$class]) ) {
            $this->discriminators[$class] = array();
        }

        if ( ! isset($this->discriminators[$class][$key]) ) {
            $this->discriminators[$class][$key] = $discriminatorClass;
        }
    }

    /**
     * Add a discriminator column to the Doctrine mapping.
     *
     * @param string $class The fully qualified class name.
     * @param array $columnDefinition The discriminator column definition options.
     */
    public function addDiscriminatorColumn ( $class, array $columnDefinition )
    {
        if ( ! isset($this->discriminatorColumns[$class]) ) {
            $this->discriminatorColumns[$class] = $columnDefinition;
        }
    }

    /**
     * Add an index to the Doctrine mapping.
     *
     * @param string $class The fully qualified class name.
     * @param string $name The name of the index.
     * @param array $columns The columns in said index.
     */
    public function addIndex ( $class, $name, array $columns )
    {
        if ( ! isset($this->indexes[$class]) ) {
            $this->indexes[$class] = array();
        }

        if ( isset($this->indexes[$class][$name]) ) {
            return;
        }

        $this->indexes[$class][$name] = $columns;
    }

    /**
     * Add an inheritance type to the Doctrine mapping.
     *
     * @param string $class The fully qualified class name.
     * @param string $type The inheritance type.
     */
    public function addInheritanceType ( $class, $type )
    {
        if ( ! isset($this->inheritanceTypes[$class]) ) {
            $this->inheritanceTypes[$class] = $type;
        }
    }

    /**
     * Get the subscribed events.
     *
     * @return array
     */
    public function getSubscribedEvents ()
    {
        return array('loadClassMetadata');
    }

    /**
     * Load class metadata.
     *
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata ( LoadClassMetadataEventArgs $eventArgs )
    {
        $metadata = $eventArgs->getClassMetadata();

        $this->loadAssociations($metadata);
        $this->loadIndexes($metadata);
        $this->loadDiscriminatorColumns($metadata);
        $this->loadDiscriminators($metadata);
        $this->loadInheritanceTypes($metadata);
    }

    /**
     * Load the Doctrine mapping associations.
     *
     * @param ClassMetadata $metadata
     * @throws \RuntimeException
     */
    private function loadAssociations ( ClassMetadata $metadata )
    {
        if ( ! array_key_exists($metadata->name, $this->associations) ) {
            return;
        }

        try {
            foreach ( $this->associations[$metadata->name] as $type => $mappings ) {
                foreach ( $mappings as $mapping ) {
                    if ( $metadata->hasAssociation($mapping['fieldName']) ) {
                        continue;
                    }

                    call_user_func(array($metadata, $type), $mapping);
                }
            }
        } catch ( \ReflectionException $e ) {
            throw new \RuntimeException(sprintf('Error with class %s : %s', $metadata->name, $e->getMessage()), 404,  $e);
        }
    }

    /**
     * Load the Doctrine mapping discriminator columns.
     *
     * @param ClassMetadata $metadata
     * @throws \RuntimeException
     */
    private function loadDiscriminatorColumns ( ClassMetadata $metadata )
    {
        if ( ! array_key_exists($metadata->name, $this->discriminatorColumns) ) {
            return;
        }

        try {
            if ( isset($this->discriminatorColumns[$metadata->name]) ) {
                $discriminatorColumns = $this->discriminatorColumns[$metadata->name];

                if ( isset($metadata->discriminatorColumn) ) {
                    $discriminatorColumns = array_merge($metadata->discriminatorColumn, $this->discriminatorColumns[$metadata->name]);
                }

                $metadata->setDiscriminatorColumn($discriminatorColumns);
            }
        } catch ( \ReflectionException $e ) {
            throw new \RuntimeException(sprintf('Error with class %s : %s', $metadata->name, $e->getMessage()), 404,  $e);
        }
    }

    /**
     * Load the Doctrine mapping discriminators.
     *
     * @param ClassMetadata $metadata
     * @throws \RuntimeException
     */
    private function loadDiscriminators ( ClassMetadata $metadata )
    {
        if ( ! array_key_exists($metadata->name, $this->discriminators) ) {
            return;
        }

        try {
            foreach ( $this->discriminators[$metadata->name] as $key => $class ) {
                if ( in_array($key, $metadata->discriminatorMap) ) {
                    continue;
                }

                $metadata->setDiscriminatorMap(array($key=>$class));
            }
        } catch ( \ReflectionException $e ) {
            throw new \RuntimeException(sprintf('Error with class %s : %s', $metadata->name, $e->getMessage()), 404,  $e);
        }
    }

    /**
     * Load the Doctrine mapping indexes.
     *
     * @param ClassMetadata $metadata
     */
    private function loadIndexes ( ClassMetadata $metadata )
    {
        if ( ! array_key_exists($metadata->name, $this->indexes) ) {
            return;
        }

        foreach ( $this->indexes[$metadata->name] as $name => $columns ) {
            $metadata->table['indexes'][$name] = array(
                'columns' => $columns
            );
        }
    }

    /**
     * Load the Doctrine mapping inheritance types.
     *
     * @param ClassMetadata $metadata
     * @throws \RuntimeException
     */
    private function loadInheritanceTypes ( ClassMetadata $metadata )
    {
        if ( ! array_key_exists($metadata->name, $this->inheritanceTypes) ) {
            return;
        }

        try {
            if ( isset($this->inheritanceTypes[$metadata->name]) ) {
                $metadata->setInheritanceType($this->inheritanceTypes[$metadata->name]);
            }
        } catch ( \ReflectionException $e ) {
            throw new \RuntimeException(sprintf('Error with class %s : %s', $metadata->name, $e->getMessage()), 404,  $e);
        }
    }

    /**
     * @param array $associations
     */
    public function setAssociations ( array $associations )
    {
        $this->associations = $associations;
    }

    /**
     * @param array $discriminatorColumns
     */
    public function setDiscriminatorColumns ( array $discriminatorColumns )
    {
        $this->discriminatorColumns = $discriminatorColumns;
    }

    /**
     * @param array $discriminators
     */
    public function setDiscriminators ( array $discriminators )
    {
        $this->discriminators = $discriminators;
    }

    /**
     * @param array $indexes
     */
    public function setIndexes ( array $indexes )
    {
        $this->indexes = $indexes;
    }

    /**
     * @param array $inheritanceTypes
     */
    public function setInheritanceTypes ( array $inheritanceTypes )
    {
        $this->inheritanceTypes = $inheritanceTypes;
    }

}