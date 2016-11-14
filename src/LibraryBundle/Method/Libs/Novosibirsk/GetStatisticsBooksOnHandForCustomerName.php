<?php

namespace Lv\LibraryBundle\Method\Novosibirsk;

use Lv\LibraryBundle\Method\BaseMethod;
use Lv\LibraryBundle\Method\Libs\LibStatisticsBooksOnHandForCustomerNameTrait;
use Lv\RpcBundle\Mapping as Rpc;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Rpc\Method("libs.novosibirsk.getStatisticsBooksOnHandForCustomerName")
 * @Rpc\Cache(lifetime=3600)
 */
class GetStatisticsBooksOnHandForCustomerName extends BaseMethod
{
    use LibStatisticsBooksOnHandForCustomerNameTrait;

    /**
     * @Rpc\Param()
     * @Assert\NotBlank()
     */
    protected $customerName;

    /**
     * @Rpc\Execute()
     */
    public function execute()
    {
        return $this->searchCustomerByCityAliasAndCustomerName('novosibirsk', $this->customerName);
    }
}
