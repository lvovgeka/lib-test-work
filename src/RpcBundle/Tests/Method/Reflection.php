<?php

namespace Lv\RpcBundle\Tests\Method;

use Lv\RpcBundle\Mapping as Rpc;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Rpc\Method("test.Reflection")
 */
class Reflection
{
    /**
     * @var null
     * @Rpc\Param()
     */
    protected $a = null;

    /**
     * @var null
     * @Rpc\Param()
     */
    protected $b = null;

    /**
     * @Rpc\Execute()
     */
	public function execute()
	{
		return $this->a + $this->b;
	}
}
