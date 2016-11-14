<?php

namespace Lv\RpcBundle\Tests\Method;

use Lv\RpcBundle\Mapping as Rpc;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Rpc\Method("get_data")
 */
class GetData
{
    /**
     * @Rpc\Execute()
     */
	public function execute()
	{
		return ["hello", 5];
	}
}
