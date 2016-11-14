<?php

namespace Lv\RpcBundle\Tests\Method;

use Lv\RpcBundle\Server\Exceptions\MethodException;
use Lv\RpcBundle\Mapping as Rpc;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Rpc\Method("exception_data")
 */
class ExceptionData
{
    /**
     * @Rpc\Execute()
     */
	public function execute()
	{
		throw new MethodException('error data');
	}
}
