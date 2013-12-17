<?php

namespace Lastdraft\Bundle\PostBundle\Controller;

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
     * @todo Can this lookup be handled by a custom ParamConverter?
     *
     * @param integer $id The ID of the post to be shown.
     * @return array
     * @Template
     */
    public function showAction ( $id )
    {
        $post = $this->get('lastdraft.repository.post')->find($id);

        return array(
            'post' => $post,
        );
    }

}
