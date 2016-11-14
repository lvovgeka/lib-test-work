<?php

namespace Lv\RpcBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class RpcMethodsCompiler implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $env = $container->getParameter('kernel.environment');
        $methods = [];


        foreach ($container->findTaggedServiceIds('rpc.method') as $id => $tags) {

            $def = $container->getDefinition($id);
            $def->setPublic(false);

            foreach ($tags as $tag) {

                if (array_key_exists('env', $tag) && $tag['env'] !== $env) {
                    break;
                }

                $name = array_key_exists('method', $tag) ? $tag['method'] : $id;
                $methods[$name] = $def->getClass();

            }

        }

        $container->setParameter('rpc.server.methods', $methods);

    }
}
