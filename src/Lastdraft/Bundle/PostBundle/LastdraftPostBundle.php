<?php

namespace Lastdraft\Bundle\PostBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;

use Lastdraft\Bundle\DoctrineBundle\DependencyInjection\Compiler\ResolveDoctrineTargetEntitiesPass;

use Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\HttpKernel\Bundle\Bundle;

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
        $interfaces = array(
            'Lastdraft\Bundle\PostBundle\Model\AddressInterface' => 'lastdraft.model.author.class',
            'Lastdraft\Bundle\PostBundle\Model\PostInterface'    => 'lastdraft.model.post.class',
        );

        $container->addCompilerPass(new ResolveDoctrineTargetEntitiesPass($interfaces));

        $mappings = array(
            realpath(__DIR__ . '/Resources/config/doctrine/model') => 'Lastdraft\Bundle\PostBundle\Model',
        );

        $container->addCompilerPass(DoctrineOrmMappingsPass::createXmlMappingDriver($mappings, array('doctrine.orm.entity_manager'), false));
    }

}
