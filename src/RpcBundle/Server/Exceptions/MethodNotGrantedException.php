<?php

namespace Lv\RpcBundle\Server\Exceptions;

use Lv\RpcBundle\Server\Exceptions\RpcException;

class MethodNotGrantedException extends RpcException
{
    protected function getDefaultMessage()
    {
        return "Method not granted";
    }

    protected function getDefaultCode()
    {
        return -32001;
    }
}
