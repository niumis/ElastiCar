<?php

namespace AppBundle\Controller\Api;

use AppBundle\Service\AutoAPI;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CarController extends Controller
{
    
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
    public function modelsAction($brand_id)
    {
        $autoAPI = $this->getAutoAPI();
        $models = $autoAPI->getModels($brand_id);

        $response = new Response();
        $response->setContent($models);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/api/ads/{brand_id}/{model_id}", requirements={"brand_id": "\d+", "model_id": "\d+"})
     * @Method("GET")
     */
    public function adsActions($brand_id, $model_id){
        $autoAPI = $this->getAutoAPI();
        $ads = $autoAPI->getAds($brand_id, $model_id);

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        $httpStatusCode = $autoAPI->getHttpStatusCode();

        if ($httpStatusCode !== 200) {
            $response->setStatusCode($httpStatusCode);
            $content = $autoAPI->getError();

        } else {
            $content = $ads->getBody();
        }

        $response->setContent($content);

        return $response;
    }

}
