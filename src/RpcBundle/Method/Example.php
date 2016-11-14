<?php

namespace Lv\RpcBundle\Method;

use Lv\RpcBundle\Mapping as Rpc;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Rpc\Method("Example")
 * @Rpc\Cache(lifetime=3600)
 */
class Example
{
    /**
     * @Rpc\Param()
     *
     */
    protected $param1;

    /**
     * @Rpc\Param()
     * @Assert\NotBlank()
     */
    protected $param2 = 'default value';

    /**
     * @Rpc\Execute()
     */
    public function execute()
    {
        return 'result : param2 - ' . $this->param2 . '; param1 - ' . $this->param1;
    }
}
