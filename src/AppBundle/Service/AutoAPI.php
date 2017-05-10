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

    public function getAds($brand_id, $model_id)
    {

        $ads = $this->request('GET', 'cars/' . $brand_id . '/' . $model_id);

        return $ads;
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
    public function getError(){
        return $this->error;
    }

    /**
     * @param $error
     * @return AutoAPI
     */
    private function setError($error){
        $this->error = $error;

        return $this;
    }

    /**
     * @return int
     */
    public function getHttpStatusCode(){
        return $this->httpStatusCode;
    }

    /**
     * @param $httpStatusCode
     * @return AutoAPI
     */
    private function setHttpStatusCode($httpStatusCode){
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
