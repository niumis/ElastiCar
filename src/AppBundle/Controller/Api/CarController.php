<?php

namespace AppBundle\Controller\Api;

use AppBundle\Service\AutoAPI;
use AppBundle\Service\Subscription;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
     * @return Subscription
     */
    private function getSubscription()
    {
        return $this->get('app.subscription');
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
    public function carsAction($brandId, $modelId)
    {
        $autoAPI = $this->getAutoAPI();

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json; charset=utf-8');
        $httpStatusCode = $autoAPI->getHttpStatusCode();

        if ($httpStatusCode !== 200) {
            $response->setStatusCode($httpStatusCode);
            $content = $autoAPI->getError();
        } else {
            $ads = $autoAPI->getAds($brandId, $modelId);
            $content = $ads;
        }

        $brand = $this->getDoctrine()
            ->getRepository('AppBundle:Brand')
            ->findOneBy(['brandId' => $brandId])
            ->getTitle();

        $model = $this->getDoctrine()
            ->getRepository('AppBundle:Model')
            ->findOneBy(['modelId' => $modelId])
            ->getTitle();

        $response->setContent($content);
        return $this->render('@App/Home/Components/ads.html.twig', [
            'ads' => json_decode($content),
            'brand' => $brand,
            'model' => $model,
        ]);
    }

    /**
     * @Route ("/api/subscribe")
     * @Method ("POST")
     */
    public function subscribeAction(Request $request)
    {
        $email = $request->request->get('email');
        $brandId = (int)$request->request->get('brandId');
        $modelId = (int)$request->request->get('modelId');

        $subscription = $this->getSubscription();
        $subscription->setEmail($email);
        $subscription->setBrandId($brandId);
        $subscription->setModelId($modelId);

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        if ($subscription->validate()) {
            $subscription->subscribe();

            //TO-DO: modify and translate response
            $responseString = json_encode([
                'message' => 'Atlikta!'
            ]);
        } else {

            $responseString = json_encode([
                'errors' => 'Invalid request.'
            ]);
            $response->setStatusCode(400);
        }

        $response->setContent($responseString);

        return $response;
    }

}
