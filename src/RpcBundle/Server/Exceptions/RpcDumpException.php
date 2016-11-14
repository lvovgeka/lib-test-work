<?php

namespace Lv\RpcBundle\Server\Exceptions;

use Exception;

class RpcDumpException extends Exception
{
    protected $data;

    public function __construct($data = null)
    {
        $this->data = $data;

        parent::__construct();
    }

    public function getData()
    {
        return $this->data;
    }
}
