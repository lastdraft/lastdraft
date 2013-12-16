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
     * {@inheritdoc}
     */
    public function build ( ContainerBuilder $container )
    {
        parent::build($container);

        $interfaces = array(
            'Lastdraft\Bundle\PostBundle\Entity\AuthorInterface' => 'lastdraft.entity.author.class',
            'Lastdraft\Bundle\PostBundle\Entity\PostInterface'   => 'lastdraft.entity.post.class',
        );

        $container->addCompilerPass(new ResolveDoctrineTargetEntitiesPass($interfaces));

        $mappings = array(
            realpath(__DIR__ . '/Resources/config/doctrine') => 'Lastdraft\Bundle\PostBundle\Entity',
        );

        $container->addCompilerPass(DoctrineOrmMappingsPass::createXmlMappingDriver(
            $mappings, array('doctrine.orm.entity_manager'), 'lastdraft_post.driver.doctrine/orm'
        ));
    }

}
