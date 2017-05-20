<?php

namespace AppBundle\Controller\Web;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $brands = $this->getDoctrine()
            ->getRepository('AppBundle:Brand')
            ->findAllWithColumns(['brandId', 'title']);

        return $this->render('AppBundle:Home:frontpage.html.twig', [
            'brands' => $brands
        ]);
    }
}
