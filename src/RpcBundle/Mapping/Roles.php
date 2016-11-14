<?php

namespace Lv\RpcBundle\Mapping;

/**
 * @Annotation
 * @Target("CLASS")
 */
final class Roles
{
	/**
	 * @var array<string>
	 */
	public $value = [];
}
