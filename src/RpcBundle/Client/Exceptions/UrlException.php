<?php

namespace Lv\RpcBundle\Client\Exceptions;

use Lv\RpcBundle\Server\Exceptions\RpcException;

class UrlException extends RpcException
{

    protected function getDefaultMessage()
    {
        return 'RpcClient tell: Url is empty, this need for send http request';
    }

    protected function getDefaultCode()
    {
        return -1;
    }
}
