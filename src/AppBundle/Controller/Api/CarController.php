<?php

namespace AppBundle\Controller\Api;

use AppBundle\Service\AutoAPI;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CarController extends Controller
{

    function __construct()
    {

    }

    /**
     * @return AutoAPI
     */
    private function getAutoAPI()
    {
        return $this->get('app.auto_api');
    }

    /**
     * @Route("/api/models/{brand_id}", requirements={"brand_id": "\d+"})
     * @Method("GET")
     */
    public function modelsAction($brand_id){
        $autoAPI = $this->getAutoAPI();
        $models = $autoAPI->getModels($brand_id);

        $response = new Response();
        $response->setContent($models);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
