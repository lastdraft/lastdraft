<?php

namespace Lastdraft\Bundle\PostBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;

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
            'Lastdraft\Bundle\PostBundle\Model\AddressInterface' => 'Lastdraft\Bundle\PostBundle\Model\Address',
            'Lastdraft\Bundle\PostBundle\Model\PostInterface'    => 'Lastdraft\Bundle\PostBundle\Model\Post',
        );

        // $container->addCompilerPass(new ResolveDoctrineTargetEntitiesPass('lastdraft_post', $interfaces));

        $mappings = array(
            realpath(__DIR__ . '/Resources/config/doctrine/model') => 'Lastdraft\Bundle\PostBundle\Model',
        );

        $container->addCompilerPass(DoctrineOrmMappingsPass::createXmlMappingDriver($mappings, array('doctrine.orm.entity_manager'), false));
    }

}
