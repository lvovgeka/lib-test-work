<?php

namespace Lv\RpcBundle\Server\Exceptions;

use RuntimeException;

abstract class RpcException extends RuntimeException
{
    /**
     * @var array
     */
    protected $data;

    /**
     * RpcException constructor.
     *
     * @param string $message
     * @param int    $code
     * @param null   $data
     */
    public function __construct($message = "", $code = 0, $data = null)
    {
        $this->data = $data;

        parent::__construct(
            $message ?: $this->getDefaultMessage(),
            intval($code ?: $this->getDefaultCode()),
            null
        );
    }

    abstract protected function getDefaultMessage();
    abstract protected function getDefaultCode();

    /**
     * Get exception data.
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
