<?php

namespace Lv\RpcBundle\Tests\Method;

use Lv\RpcBundle\Mapping as Rpc;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Rpc\Method("subtract")
 */
class Subtract
{
    /**
     * @var null
     * @Rpc\Param()
     */
    protected $subtrahend;

    /**
     * @var null
     * @Rpc\Param()
     */
    protected $minuend;

    /**
     * @Rpc\Execute()
     */
	public function execute()
	{
		return $this->subtrahend - $this->minuend;
	}
}
