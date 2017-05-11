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
     * @Route("/api/models/{brandId}", requirements={"brandId": "\d+"})
     * @Method("GET")
     */
    public function modelsAction($brandId)
    {
        $models = $this->getDoctrine()
            ->getRepository('AppBundle:Model')
            ->findByBrandWithColumns($brandId, ['modelId', 'title']);
        $models = json_encode($models);

        $response = new Response();
        $response->setContent($models);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/api/cars/{brandId}/{modelId}", requirements={"brandId": "\d+", "modelId": "\d+"})
     * @Method("GET")
     */
    public function carsActions($brandId, $modelId)
    {
        $autoAPI = $this->getAutoAPI();
        $ads = $autoAPI->getAds($brandId, $modelId);

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');
        $httpStatusCode = $autoAPI->getHttpStatusCode();

        if ($httpStatusCode !== 200) {

            $response->setStatusCode($httpStatusCode);
            $content = $autoAPI->getError();

        } else {
            $content = $ads;
        }

        $response->setContent($content);
        return $this->render('@App/Home/Components/ads.html.twig', array('ads' => json_decode($content  )));
    }

}