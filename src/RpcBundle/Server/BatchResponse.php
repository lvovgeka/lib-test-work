<?php

namespace Lv\RpcBundle\Server;

use Lv\RpcBundle\Interfaces\Support\JsonableInterface;
use Lv\RpcBundle\Interfaces\Support\ArrayableInterface;

class BatchResponse implements JsonableInterface, ArrayableInterface
{
    /**
     * @var array
     */
    protected $responses = [];

    /**
     * @param  \Lv\RpcBundle\Interfaces\Support\ArrayableInterface $response
     */
    public function add(ArrayableInterface $response)
    {
        $this->responses[] = $response;
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        $array = $this->toArray();

        return json_encode(count($array) ? $array : null, $options);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return array_map(
            function (ArrayableInterface $response) {
                return (object) $response->toArray();
            },
            $this->responses
        );
    }
}
