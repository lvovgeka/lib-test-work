<?php

namespace Lv\RpcBundle\Server\Exceptions;

use Lv\RpcBundle\Server\Exceptions\RpcException;

class MethodNotFoundException extends RpcException
{
    protected function getDefaultMessage()
    {
        return "Method not found";
    }

    protected function getDefaultCode()
    {
        return -32601;
    }
}
