<?php

namespace Lv\RpcBundle\Client;

use GuzzleHttp\Client;
use Lv\RpcBundle\Mapping\Execute;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Lv\RpcBundle\Server\Request;
use Psr\Http\Message\ResponseInterface;
use Lv\RpcBundle\Client\Exceptions\UrlException;

class Handler{


    /**
     * http client
     *
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * Response
     *
     * @var ResponseInterface
     */
    protected $response = null;

    /**
     * Flag for batch sending
     *
     * @var bool
     */
    protected $multi = false;


    /**
     * For http request
     *
     * @var array
     */
    protected $options = [];

    /**
     * Id request
     *
     * @var int
     */
    protected $id = 0;

    /**
     * Url request
     *
     * @var string
     */
    protected $url = null;

    /**
     * jsonrpc payload
     *
     * @var array
     */
    protected $payload = [];

    /**
     * Create new instance.
     *
     * @param \GuzzleHttp\Client $httpClient Instance of \GuzzleHttp\Client
     */
    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Url for rpc request
     *
     * @param $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Execute one request or build batch request
     *
     * @param $method
     * @param array $params
     * @param null $id
     * @param null $url
     * @return Handler
     */
    public function call($method, $params = [], $id = null, $url = null)
    {
        if($url){
            $this->url = $url;
        }
        return $this->work($method, $params, $id);
    }

    /**
     * Worker
     *
     * @param $method
     * @param $params
     * @param null $id
     * @return $this|Handler
     */
    protected function work($method, $params, $id = null)
    {
        $request = new Request($method, $params, $id ?: ++ $this->id);

        $this->payload[] = $request->toJson();

        if (!$this->multi)
        {
            return $this->send();
        }

        return $this;
    }

    /**
     * Send http rpc request
     *
     * @return $this
     */
    protected function send()
    {
        if(!$this->url){
            throw new UrlException;
        }

        $opt = [];
        if ($this->multi)
        {
            $opt['body'] = '[' . implode(',', $this->payload) . ']';
        }
        else
        {
            $opt['body'] = $this->payload[0];
        }

        $this->response = $this->httpClient->post($this->url, $opt);

        $this->resetPayload();

        return $this;
    }

    /**
     * Reset current payload
     *
     * @return $this
     */
    protected function resetPayload()
    {
        $this->payload = [];
        return $this;
    }

    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * Told about need batch rpc request
     *
     * @return $this
     */
    public function batchOpen()
    {
        $this->multi = true;
        return $this;
    }

    /**
     * Execute batch rpc request
     *
     * @return Handler
     * @throws \Exception
     */
    public function batchSend()
    {
        if (count($this->payload) === 1)
        {
            throw new \Exception('Batch only has one payload');
        }

        return $this->send();
    }

    /**
     * Convert result to array
     *
     * @return array
     */
    public function resultToArray()
    {
        return $this->parseJson(true);
    }

    /**
     * Convert result to object
     *
     * @return object
     */
    public function resultToObject()
    {
        return $this->parseJson();
    }

    /**
     * Parse json from response
     * @param bool $assoc
     * @return array|object
     */
    protected function parseJson($assoc = false)
    {
        if($this->response instanceof ResponseInterface){
            $payload = $this->response->getBody()->getContents();

            $payload = json_decode($payload, $assoc);

            if (json_last_error() == JSON_ERROR_NONE) {
                return ( count($payload) == 1 && is_array($payload) ? $payload[0] : $payload );
            }
        }
        return ($assoc ? [] : (object)[]);
    }
}