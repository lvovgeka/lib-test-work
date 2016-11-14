<?php

namespace Lv\RpcBundle\Server\Exceptions;

use Lv\RpcBundle\Server\Exceptions\RpcException;

class ParseErrorException extends RpcException
{
    protected function getDefaultMessage()
    {
        return 'Parse error';
    }

    protected function getDefaultCode()
    {
        return -32700;
    }
}
