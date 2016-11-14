<?php

namespace Lv\RpcBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Lv\RpcBundle\DependencyInjection\Compiler\RpcMethodsCompiler;

class RpcBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new RpcMethodsCompiler());
    }
}
