<?php

namespace Lv\RpcBundle\Server;

use Lv\RpcBundle\Server\Exceptions\InvalidRequestException;

class Request
{
    /**
     * @var string
     */
    protected $method;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var null|string|int
     */
    protected $id = null;

    /**
     * @param string          $method
     * @param array|null      $params
     * @param string|int|null $id
     */
    public function __construct($method, array $params = [], $id = null)
    {
        $this->method = $method;
        $this->params = $params;

        $this->id = ( ! is_null($id) && ! is_int($id) )
            ? (string) $id
            : $id;
    }

    /**
     * Create request from payload.
     *
     * @param  array $payload
     *
     * @return \Lv\RpcBundle\Server\Request
     *
     * @throws \Lv\RpcBundle\Server\Exceptions\InvalidRequestException
     */
    public static function createFromPayload($payload)
    {
        if ( ! is_array($payload)) {
            throw new InvalidRequestException;
        }

        if (empty( $payload['jsonrpc'] ) || $payload['jsonrpc'] !== "2.0") {
            throw new InvalidRequestException;
        }

        if (empty( $payload['method'] ) || ! is_string($payload['method'])) {
            throw new InvalidRequestException;
        }

        $params = [];

        if ( ! empty( $payload['params'] )) {
            if (is_array($payload['params'])) {
                $params = $payload['params'];
            }
            else {
                throw new InvalidRequestException;
            }
        }

        if (isset( $payload['id'] )) {
            if ( ! is_string($payload['id']) && ! is_numeric($payload['id']) && ! is_null($payload['id'])) {
                throw new InvalidRequestException;
            }
        }

        return new static(
            $payload['method'], $params, isset( $payload['id'] ) ? $payload['id'] : null
        );
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return null|string|int
     */
    public function getId()
    {
        return $this->id;
    }

    public function toArray()
    {
        $array = ['jsonrpc' => '2.0'];

        $array['method'] = $this->method;

        if ($this->params)
        {
            $array['params'] = $this->params;
        }

        if ($this->id)
        {
            $array['id'] = $this->id;
        }

        return $array;
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }

    public function getHash()
    {
        return md5( $this->method . json_encode( (array) $this->params ) );
    }
}
