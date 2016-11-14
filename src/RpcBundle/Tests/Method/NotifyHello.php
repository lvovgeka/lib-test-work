<?php

namespace Lv\RpcBundle\Tests\Method;

use Lv\RpcBundle\Mapping as Rpc;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Rpc\Method("notify_hello")
 * @Rpc\Cache(lifetime=3600)
 */
class NotifyHello
{

    /**
     * @Rpc\Execute()
     */
	public function execute()
	{
		return 'Hello';
	}
}
