<?php

namespace Lv\RpcBundle\Server\Exceptions;

use Lv\RpcBundle\Server\Exceptions\RpcException;

class InvalidParamsException extends RpcException
{
    protected function getDefaultMessage()
    {
        return 'Invalid params';
    }

    protected function getDefaultCode()
    {
        return -32602;
    }
}
