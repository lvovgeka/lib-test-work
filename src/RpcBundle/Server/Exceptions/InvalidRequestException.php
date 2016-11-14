<?php

namespace Lv\RpcBundle\Server\Exceptions;

use Lv\RpcBundle\Server\Exceptions\RpcException;

class InvalidRequestException extends RpcException
{
    protected function getDefaultMessage()
    {
        return 'Invalid Request';
    }

    protected function getDefaultCode()
    {
        return -32600;
    }
}
