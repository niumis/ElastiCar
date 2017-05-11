<?php
/**
 * Created by PhpStorm.
 * User: darker
 * Date: 17.5.8
 * Time: 16.34
 */

namespace AppBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use GuzzleHttp\Client;

class AutoAPI
{
    private $container;

    private $httpStatusCode = 200;
    private $error = '';

    function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param $brand_id
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getModels($brand_id = '')
    {
        $endpoint = empty($brand_id) ? 'models' : 'models/' . $brand_id;
        $models = $this->request('GET', $endpoint);

        return $models->getBody();
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function getBrands()
    {
        $brands = $this->request('GET', 'brands');

        return $brands->getBody();
    }

    /**
     * @param $brand_id
     * @param $model_id
     * @return mixed|\Psr\Http\Message\ResponseInterface|string
     */
    public function getAds($brand_id, $model_id)
    {

        $ads = $this->request('GET', 'cars/' . $brand_id . '/' . $model_id);
        $ads = $ads->getBody()->getContents();

        $ads = json_decode($ads);
        $ads = $this->addInsertedOn($ads);


        usort($ads, function ($a, $b) {
            return ($b->inserted_on - $a->inserted_on);
        });


        $ads = json_encode($ads);
        return $ads;
    }

    /**
     * @param $ads
     * @return mixed
     */
    private function addInsertedOn($ads)
    {

        array_map(function (&$ad) {

            $timeToSubtract = 0;
            foreach ($ad->inserted_before as $timeAmount) {
                $timeAmount = str_replace(['val', 'min', 'd'], ['hours', 'minutes', 'days'], $timeAmount);
                $timeToSubtract += time() - strtotime('-' . $timeAmount);
            }


            $insertedBefore = time() - $timeToSubtract;
            $ad->inserted_before = $this->secondsToTimeString($timeToSubtract);
            $ad->inserted_on = $insertedBefore;

        }, $ads);

        return $ads;
    }

    /**
     * @param $seconds
     * @return string
     */
    public function secondsToTimeString($seconds)
    {
        //TO-DO: Needs to be translated

        $time = '';
        if ($seconds < 60) {
            $time = 'Prieš 1 min.';
        } else if ($seconds < (60 * 60)) {
            $time = 'Prieš ' . floor($seconds / 60) . ' min.';
        } else if ($seconds < (24 * 60 * 60)) {
            $time = 'Prieš ' . (floor($seconds / (60 * 60)) + 1) . ' val.';
        } else {
            $time = 'Prieš 1 d.';
        }

        return $time;
    }

    /**
     * @param string $method
     * @param string $endpoint
     * @param array $query
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    private function request($method, $endpoint, Array $query = [])
    {
        $api_host = $this->getApiHost();
        $api_key = $this->getApiKey();

        try {
            $client = new Client([
                'base_uri' => $api_host
            ]);

            $key_query = ['key' => $api_key];
            $query = empty($query) ? $key_query : array_merge($key_query, $query);

            $response = $client->request($method, $endpoint, [
                'query' => $query
            ]);
        } catch (\Exception $e) {

            $this->setHttpStatusCode($e->getCode())->setError('Invalid query.');
            return false;
        }

        return $response;
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param $error
     * @return AutoAPI
     */
    private function setError($error)
    {
        $this->error = $error;

        return $this;
    }

    /**
     * @return int
     */
    public function getHttpStatusCode()
    {
        return $this->httpStatusCode;
    }

    /**
     * @param $httpStatusCode
     * @return AutoAPI
     */
    private function setHttpStatusCode($httpStatusCode)
    {
        $this->httpStatusCode = $httpStatusCode;

        return $this;
    }

    /**
     * @return string
     */
    private function getApiHost()
    {
        // Not sure if this is the best place to store API details
        return $this->container->getParameter('app.api_host');
    }

    /**
     * @return string
     */
    private function getApiKey()
    {
        // Not sure if this is the best place to store API details
        return $this->container->getParameter('app.api_key');
    }

}
