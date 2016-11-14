<?php

namespace Lv\RpcBundle\Mapping;

/**
 * @Annotation
 * @Target("CLASS")
 */
final class Env
{
	/**
	 * @var array<string>
	 */
	public $value;
}
