<?php

namespace Lv\LibraryBundle\Method\Moscow;

use Lv\LibraryBundle\Method\BaseMethod;
use Lv\LibraryBundle\Method\Libs\LibBooksStatOnHandTrait;
use Lv\RpcBundle\Mapping as Rpc;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Rpc\Method("libs.moskva.getStatisticsBooksOnHand")
 * @Rpc\Cache(lifetime=3600)
 */
class GetStatisticsBooksOnHand extends BaseMethod
{
    use LibBooksStatOnHandTrait;

    /**
     * @Rpc\Param()
     */
    protected $dateFrom = null;

    /**
     * @Rpc\Execute()
     */
    public function execute()
    {
        $this->dateFrom = $this->dateFrom ?: (new \DateTime())->sub(new \DateInterval('P1D'));

        $res = $this->getStatByLibAlias('moskva', $this->dateFrom);

        return $this->serialize($res);
    }
}
