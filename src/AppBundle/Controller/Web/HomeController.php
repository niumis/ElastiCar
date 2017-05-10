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
        //$brands = $this->container->get('app.auto_api')->getBrands();
        $brands = $this->getDoctrine()
            ->getRepository('AppBundle:Brand')
            ->findAllByColumns(['brandId', 'title']);

        return $this->render('AppBundle:Home:frontpage.html.twig', [
            'brands' => json_encode($brands)
        ]);
    }

}
