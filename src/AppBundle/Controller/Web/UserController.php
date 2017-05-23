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
        return $this->render('@App/User/index.html.twig', [
        ]);
    }
}
