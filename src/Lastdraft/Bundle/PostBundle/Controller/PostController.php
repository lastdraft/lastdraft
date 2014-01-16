<?php

namespace Lastdraft\Bundle\PostBundle\Controller;

use Lastdraft\Bundle\PostBundle\Model\PostInterface;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class PostController
 *
 * @package Lastdraft\Bundle\PostBundle\Controller
 */
class PostController extends Controller
{

    /**
     * Show a listing of the most recent posts.
     *
     * @return array
     * @Template
     */
    public function indexAction ()
    {
        return array();
    }

    /**
     * Show an individual post.
     *
     * @param PostInterface $post The post to be shown.
     * @return array
     * @Template
     */
    public function showAction ( PostInterface $post )
    {
        return array(
            'post' => $post,
        );
    }

    /**
     * Edit an individual post.
     *
     * @param PostInterface $post The post to be edited.
     * @return array
     * @Template
     */
    public function editAction ( PostInterface $post )
    {
        return array(
            'post' => $post,
        );
    }

}
