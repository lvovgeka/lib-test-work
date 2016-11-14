<?php

namespace Lv\RpcBundle\Test;

use PHPUnit_Framework_TestCase;
use Lv\RpcBundle\Server\Handler;
use Lv\RpcBundle\Server\Manager;
use Symfony\Component\HttpFoundation\Request;

class ReflectionTest extends PHPUnit_Framework_TestCase
{

    /**
     * @return Handler
     */
    public function getHandler()
    {
        $methods = [
            'reflection' => \Lv\RpcBundle\Tests\Method\Reflection::class,
        ];

        return new Handler(null, new Manager(null, $methods));
    }

    /**
     * @return Request
     */
    public function getHttpRequest($json)
    {
        $query = [];
        $request = [];
        $attributes = [];
        $cookies = [];
        $files = [];
        $server = [];
        $content = $json;

        return new Request($query, $request, $attributes, $cookies, $files, $server, $content);
    }

    public function testReflection()
    {
        $handler = $this->getHandler();
        $request = $this->getHttpRequest('{"jsonrpc": "2.0", "method": "reflection", "params": {"a":1, "b":1}, "id": 1}');
        $response = $handler->handleHttpRequest($request);

        $this->assertEquals('{"jsonrpc":"2.0","result":2,"id":1}', $response->getContent(), $response->getContent());
    }
}
