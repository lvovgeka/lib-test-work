<?php

namespace Lv\RpcBundle\Tests\Method;

use Lv\RpcBundle\Mapping as Rpc;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Rpc\Method("update")
 */
class Update
{
    /**
     * @Rpc\Param()
     * @Assert\NotBlank()
     */
    protected $a;

    /**
     * @Rpc\Param()
     * @Assert\NotBlank()
     */
    protected $b;

    /**
     * @Rpc\Param()
     * @Assert\NotBlank()
     */
    protected $c;

    /**
     * @Rpc\Param()
     * @Assert\NotBlank()
     */
    protected $d;

    /**
     * @Rpc\Param()
     * @Assert\NotBlank()
     */
    protected $e;


    /**
     * @Rpc\Execute()
     */
	public function execute()
	{
		// Notification
	}
}
