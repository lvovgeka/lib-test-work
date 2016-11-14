<?php

namespace Lv\RpcBundle\Mapping;

/**
 * @Annotation
 * @Target("CLASS")
 */
final class Cache
{
	/**
	 * @var integer
	 */
	public $lifetime = 0;

}
