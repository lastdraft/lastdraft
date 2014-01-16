<?php

namespace Lastdraft\Bundle\PostBundle\Request\ParamConverter;

use Doctrine\ORM\EntityRepository;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter,
    Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;

use Symfony\Component\HttpFoundation\Request;

/**
 * Class PostParamConverter
 *
 * @package Lastdraft\Bundle\PostBundle\Request\ParamConverter
 */
class PostParamConverter implements ParamConverterInterface
{

    /**
     * The post repository.
     *
     * @var EntityRepository
     */
    public $repository;

    /**
     * Constructor, set the post repository.
     *
     * @param EntityRepository $repository
     */
    public function __construct ( EntityRepository $repository )
    {
        $this->repository = $repository;
    }

    /**
     * {@inheritdoc}
     */
    public function apply ( Request $request, ParamConverter $configuration )
    {
        $post = $this->repository->find($request->get('id'));
        $request->attributes->set($configuration->getName(), $post);
    }

    /**
     * {@inheritdoc}
     */
    public function supports ( ParamConverter $configuration )
    {
        return ( $configuration->getClass() == 'Lastdraft\Bundle\PostBundle\Model\PostInterface' );
    }

}