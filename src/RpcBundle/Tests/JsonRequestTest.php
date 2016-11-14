<?php

namespace Lv\RpcBundle\Test;

use PHPUnit_Framework_TestCase;
use Lv\RpcBundle\Server\Exceptions\InvalidRequestException;
use Lv\RpcBundle\Server\Request;

class JsonRequestTest extends PHPUnit_Framework_TestCase
{

	public function testNullRequest()
	{
		try
		{
			Request::createFromPayload(
				(object) [
					'jsonrpc' => '2.0',
					'method'  => null,
					'params'  => null,
					'id'      => null,
				]
			);

			$this->assertEquals(true, false);
		}
		catch (InvalidRequestException $exception)
		{
			$this->assertEquals(true, true);
		}
		catch (\Exception $exception)
		{
			$this->assertEquals(true, false);
		}
	}

	/**
	 * @depends testNullRequest
	 */
	public function testParamsStringRequest()
	{
		try
		{
			Request::createFromPayload(
				(object) [
					'jsonrpc' => '2.0',
					'method'  => null,
					'params'  => 'string',
					'id'      => null,
				]
			);

			$this->assertEquals(true, false);
		}
		catch (InvalidRequestException $exception)
		{
			$this->assertEquals(true, true);
		}
		catch (\Exception $exception)
		{
			$this->assertEquals(true, false);
		}
	}

	/**
	 * @depends testNullRequest
	 */
	public function testParamsArrayRequest()
	{
		try
		{
			Request::createFromPayload(
				(object) [
					'jsonrpc' => '2.0',
					'method'  => 'string',
					'params'  => [1, 2, 3],
					'id'      => 1,
				]
			);

			$this->assertEquals(true, true);
		}
		catch (InvalidRequestException $exception)
		{
			$this->assertEquals(true, false);
		}
		catch (\Exception $exception)
		{
			$this->assertEquals(true, false);
		}
	}

	/**
	 * @depends testNullRequest
	 */
	public function testMethodNullRequest()
	{
		try
		{
			Request::createFromPayload(
				(object) [
					'jsonrpc' => '2.0',
					'method'  => null,
					'params'  => [1, 2, 3],
					'id'      => 1,
				]
			);

			$this->assertEquals(true, false);
		}
		catch (InvalidRequestException $exception)
		{
			$this->assertEquals(true, true);
		}
		catch (\Exception $exception)
		{
			$this->assertEquals(true, false);
		}
	}

	/**
	 * @depends testNullRequest
	 */
	public function testMethodArrayRequest()
	{
		try
		{
			Request::createFromPayload(
				(object) [
					'jsonrpc' => '2.0',
					'method'  => [1, 2, 3],
					'params'  => [],
					'id'      => 1,
				]
			);

			$this->assertEquals(true, false);
		}
		catch (InvalidRequestException $exception)
		{
			$this->assertEquals(true, true);
		}
		catch (\Exception $exception)
		{
			$this->assertEquals(true, false);
		}
	}

}
