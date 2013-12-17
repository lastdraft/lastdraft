<?php

namespace Lastdraft\Bundle\DoctrineMapperBundle\Collector;

/**
 * Class DoctrineCollector
 *
 * @package Lastdraft\Bundle\DoctrineMapperBundle\Collector
 */
class DoctrineCollector
{

    /**
     * An array of associations.
     *
     * @var array
     */
    protected $associations;

    /**
     * An array of discriminator columns.
     *
     * @var array
     */
    protected $discriminatorColumns;

    /**
     * An array of discriminators.
     *
     * @var array
     */
    protected $discriminators;

    /**
     * An array of indexes.
     *
     * @var array
     */
    protected $indexes;

    /**
     * An array of inheritance types.
     *
     * @var array
     */
    protected $inheritanceTypes;

    /**
     * Instance of DoctrineCollector.
     *
     * @var DoctrineCollector
     */
    private static $instance;

    /**
     * Simple constructor, initialize class variables.
     */
    public function __construct ()
    {
        $this->associations = array();
        $this->discriminatorColumns = array();
        $this->discriminators = array();
        $this->indexes = array();
        $this->inheritanceTypes = array();
    }

    /**
     * Get an instance of DoctrineCollector.
     *
     * @return DoctrineCollector
     */
    public static function getInstance ()
    {
        if ( ! self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Add an association to the Doctrine mapping.
     *
     * @param string $class The fully qualified class name.
     * @param string $type The type of association.
     * @param array $options The association options.
     */
    public function addAssociation ( $class, $type, array $options )
    {
        $type = sprintf('map%s', $type);

        if ( ! isset($this->associations[$class]) ) {
            $this->associations[$class] = array();
        }

        if ( ! isset($this->associations[$class][$type]) ) {
            $this->associations[$class][$type] = array();
        }

        $this->associations[$class][$type][] = $options;
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
     * Return the mapping's associations.
     *
     * @return array
     */
    public function getAssociations ()
    {
        return $this->associations;
    }


    /**
     * Return the mapping's discriminator columns.
     *
     * @return array
     */
    public function getDiscriminatorColumns ()
    {
        return $this->discriminatorColumns;
    }

    /**
     * Return the mapping's discriminators.
     *
     * @return array
     */
    public function getDiscriminators ()
    {
        return $this->discriminators;
    }

    /**
     * Return the mapping's indexes.
     *
     * @return array
     */
    public function getIndexes ()
    {
        return $this->indexes;
    }

    /**
     * Return the mapping's inheritance types.
     *
     * @return array
     */
    public function getInheritanceTypes ()
    {
       return $this->inheritanceTypes;
    }

}
