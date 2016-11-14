<?php

namespace Lv\RpcBundle\Server\Exceptions;

use Lv\RpcBundle\Server\Exceptions\RpcException;

class InternalErrorException extends RpcException
{
    protected function getDefaultMessage()
    {
        return 'Internal error';
    }

    protected function getDefaultCode()
    {
        return -32603;
    }
}
