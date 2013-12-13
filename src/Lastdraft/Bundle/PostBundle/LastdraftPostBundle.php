<?php

namespace Lastdraft\Bundle\PostBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;

use Lastdraft\Bundle\PostBundle\DependencyInjection\Compiler\ResolveDoctrineTargetEntitiesPass;

use Symfony\Component\HttpKernel\Bundle\Bundle,
    Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class LastdraftPostBundle
 *
 * @package Lastdraft\Bundle\PostBundle
 */
class LastdraftPostBundle extends Bundle
{

    /**
     * Return array of currently supported drivers.
     *
     * @return array
     */
    /*
    public static function getSupportedDrivers ()
    {
        return array('doctrine/orm');
    }
    */

    /**
     * {@inheritdoc}
     */
    public function build ( ContainerBuilder $container )
    {
        $interfaces = array(
            'Lastdraft\Bundle\PostBundle\Entity\AuthorInterface' => 'lastdraft_post.author.entity',
            'Lastdraft\Bundle\PostBundle\Entity\PostInterface'   => 'lastdraft_post.post.entity',
        );

        $container->addCompilerPass(new ResolveDoctrineTargetEntitiesPass('lastdraft_post', $interfaces));

        $mappings = array(
            realpath(__DIR__ . '/Resources/config/doctrine') => 'Lastdraft\Bundle\PostBundle\Entity',
        );

        $container->addCompilerPass(DoctrineOrmMappingsPass::createXmlMappingDriver(
            $mappings, array('doctrine.orm.entity_manager'), 'lastdraft_post.driver.doctrine/orm'
        ));
    }

}
