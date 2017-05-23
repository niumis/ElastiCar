<?php

namespace AppBundle\Controller\Web;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    /**
     * @Route("/user", name="user_index")
     */
    public function indexAction()
    {
        $userId = $this->get('security.token_storage')->getToken()->getUser();
        $watchlist = $this->getDoctrine()
            ->getRepository('AppBundle:Watchlist')
            ->findByUser($userId);

        // $user = $watchlist->getUser();
        return $this->render('@App/User/index.html.twig', [
            'useris' => $watchlist,
        ]);
    }

    /**
     * @Route("/user/show", name="user_show")
     */
    public function showAction ()
    {
        return $this->render('@App/User/show.html.twig', [
        ]);
    }
}
