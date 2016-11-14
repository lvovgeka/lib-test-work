<?php

namespace Lv\RpcBundle\Server\Exceptions;

use Lv\RpcBundle\Server\Exceptions\RpcErrorException;

class MethodException extends RpcErrorException
{
    public function __construct($data = null)
    {
        parent::__construct('Method Error.', -32002, $data);
    }
}
