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
     * Tell Symfony that we have stored our entities in the "Model" directory instead of the default "Entity" directory.
     *
     * {@inheritdoc}
     */
    public function build ( ContainerBuilder $container )
    {
        $modelPath = $container->getParameter('kernel.root_dir') . '/../src/Lastdraft/Bundle/PostBundle/Resources/config/doctrine/model';
        $mappings  = array(
            $modelPath => 'Lastdraft\Bundle\PostBundle\Model',
        );

        $container->addCompilerPass(DoctrineOrmMappingsPass::createXmlMappingDriver(
            $mappings, array('doctrine.orm.entity_manager'), false)
        );
    }

}
