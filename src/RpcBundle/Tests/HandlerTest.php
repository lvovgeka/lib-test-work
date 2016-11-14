<?php

namespace Lv\RpcBundle\Test;

use PHPUnit_Framework_TestCase;
use Lv\RpcBundle\Server\Handler;
use Lv\RpcBundle\Server\Mapper;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HandlerTest extends WebTestCase
{
    protected static $handler = null;

    /**
     * @return Mapper
     */
    public function getMapper()
    {
        $m = new Mapper();
        $m->setMeta($m->loadPathMetadata(__DIR__ . '/Method'));
        return $m;
    }

    /**
     * @return Handler
     */
    public function getHandler()
    {
        if(!self::$handler){
            static::bootKernel([]);
            $container = static::$kernel->getContainer();
            self::$handler = new Handler($container, $this->getMapper());
        }

        return self::$handler;
    }

    /**
     * @param $json
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

    public function testHttpRequest_1()
    {
        $handler = $this->getHandler();
        $request = $this->getHttpRequest('{"jsonrpc": "2.0", "method": "subtract", "params":  { "subtrahend" : 42, "minuend" : 23 }, "id": 1}');
        $response = $handler->handleHttpRequest($request);

        $this->assertEquals('{"jsonrpc":"2.0","result":19,"id":1}', $response->getContent(), $response->getContent());
    }

    public function testHttpRequest_2()
    {
        $handler = $this->getHandler();
        $request = $this->getHttpRequest('{"jsonrpc": "2.0", "method": "subtract", "params": { "subtrahend" : 23, "minuend" : 42 }, "id": 1}');
        $response = $handler->handleHttpRequest($request);

        $this->assertEquals('{"jsonrpc":"2.0","result":-19,"id":1}', $response->getContent(), $response->getContent());
    }

    public function testHttpRequest_3()
    {
        $handler = $this->getHandler();
        $request = $this->getHttpRequest('{"jsonrpc": "2.0", "method": "subtract", "params": {"subtrahend": 23, "minuend": 42}, "id": 1}');
        $response = $handler->handleHttpRequest($request);

        $this->assertEquals('{"jsonrpc":"2.0","result":-19,"id":1}', $response->getContent(), $response->getContent());
    }

    public function testHttpRequest_4()
    {
        $handler = $this->getHandler();
        $request = $this->getHttpRequest('{"jsonrpc": "2.0", "method": "subtract", "params": {"minuend": 42, "subtrahend": 23}, "id": 1}');
        $response = $handler->handleHttpRequest($request);

        $this->assertEquals('{"jsonrpc":"2.0","result":-19,"id":1}', $response->getContent(), $response->getContent());
    }

    public function testHttpRequest_5()
    {
        $handler = $this->getHandler();
        $request = $this->getHttpRequest('{"jsonrpc": "2.0", "method": "update", "params": {"a" : 1,"b" : 2,"c" : 3,"d" : 4,"e" : 5}}');
        $response = $handler->handleHttpRequest($request);

        $this->assertEquals('', $response->getContent(), $response->getContent());
    }

    public function testHttpRequest_6()
    {
        $handler = $this->getHandler();
        $request = $this->getHttpRequest('{"jsonrpc": "2.0", "method": "foobar", "id": "1"}');
        $response = $handler->handleHttpRequest($request);

        $this->assertEquals('{"jsonrpc":"2.0","error":{"code":-32601,"message":"Method not found"},"id":"1"}', $response->getContent(), $response->getContent());
    }

    public function testHttpRequest_7()
    {
        $handler = $this->getHandler();
        $request = $this->getHttpRequest('{"jsonrpc": "2.0", "method": "foobar, "params": "bar", "baz]');
        $response = $handler->handleHttpRequest($request);

        $this->assertEquals('{"jsonrpc":"2.0","error":{"code":-32700,"message":"Parse error"},"id":null}', $response->getContent(), $response->getContent());
    }

    public function testHttpRequest_8()
    {
        $handler = $this->getHandler();
        $request = $this->getHttpRequest('{"jsonrpc": "2.0", "method": 1, "params": "bar"}');
        $response = $handler->handleHttpRequest($request);

        $this->assertEquals('{"jsonrpc":"2.0","error":{"code":-32600,"message":"Invalid Request"},"id":null}', $response->getContent(), $response->getContent());
    }

    public function testHttpRequest_9()
    {
        $handler = $this->getHandler();
        $request = $this->getHttpRequest('[{"jsonrpc": "2.0", "method": "sum", "params": [1,2,4], "id": "1"}, {"jsonrpc": "2.0", "method"]');
        $response = $handler->handleHttpRequest($request);

        $this->assertEquals('{"jsonrpc":"2.0","error":{"code":-32700,"message":"Parse error"},"id":null}', $response->getContent(), $response->getContent());
    }

    public function testHttpRequest_10()
    {
        $handler = $this->getHandler();
        $request = $this->getHttpRequest('[]');
        $response = $handler->handleHttpRequest($request);

        $this->assertEquals('{"jsonrpc":"2.0","error":{"code":-32600,"message":"Invalid Request"},"id":null}', $response->getContent(), $response->getContent());
    }

    public function testHttpRequest_11()
    {
        $handler = $this->getHandler();
        $request = $this->getHttpRequest('[1]');
        $response = $handler->handleHttpRequest($request);

        $this->assertEquals('[{"jsonrpc":"2.0","error":{"code":-32600,"message":"Invalid Request"},"id":null}]', $response->getContent(), $response->getContent());
    }

    public function testHttpRequest_12()
    {
        $handler = $this->getHandler();
        $request = $this->getHttpRequest('[1,2,3]');
        $response = $handler->handleHttpRequest($request);

        $this->assertEquals('[{"jsonrpc":"2.0","error":{"code":-32600,"message":"Invalid Request"},"id":null},{"jsonrpc":"2.0","error":{"code":-32600,"message":"Invalid Request"},"id":null},{"jsonrpc":"2.0","error":{"code":-32600,"message":"Invalid Request"},"id":null}]', $response->getContent(), $response->getContent());
    }

    public function testHttpRequest_13()
    {
        $handler = $this->getHandler();
        $request = $this->getHttpRequest(
            '[
                {"jsonrpc": "2.0", "method": "sum", "params": {"a" : 1, "b" : 2, "c": 4}, "id": "1"},
                {"jsonrpc": "2.0", "method": "notify_hello", "params": {"a" : 7}},
                {"jsonrpc": "2.0", "method": "subtract", "params": {"subtrahend" : 42, "minuend" : 23}, "id": "2"},
                {"foo": "boo"},
                {"jsonrpc": "2.0", "method": "foo.get", "params": {"name": "myself"}, "id": "5"},
                {"jsonrpc": "2.0", "method": "get_data", "id": "9"}
             ]'
        );
        $response = $handler->handleHttpRequest($request);

        $this->assertEquals('[{"jsonrpc":"2.0","result":7,"id":"1"},{"jsonrpc":"2.0","result":19,"id":"2"},{"jsonrpc":"2.0","error":{"code":-32600,"message":"Invalid Request"},"id":null},{"jsonrpc":"2.0","error":{"code":-32601,"message":"Method not found"},"id":"5"},{"jsonrpc":"2.0","result":["hello",5],"id":"9"}]', $response->getContent(), $response->getContent());
    }

    public function testHttpRequest_14()
    {
        $handler = $this->getHandler();
        $request = $this->getHttpRequest('{"jsonrpc": "2.0", "method": "exception_data", "id": "1"}');
        $response = $handler->handleHttpRequest($request);

        $this->assertEquals('{"jsonrpc":"2.0","error":{"code":-32002,"message":"Method Error.","data":"error data"},"id":"1"}', $response->getContent(), $response->getContent());
    }
}
