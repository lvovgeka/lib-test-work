<?php

namespace Lv\LibraryBundle\Method\CentralizedRepository;

use Lv\LibraryBundle\Method\BaseMethod;
use Lv\RpcBundle\Mapping as Rpc;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Rpc\Method("centralizedRepository.getStatisticsBooksOnHandForCustomerName")
 * @Rpc\Cache(lifetime=3600)
 */
class GetStatisticsBooksOnHandForCustomerName extends BaseMethod
{

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
        $libs = $this->container->get('doctrine.orm.default_entity_manager')
            ->getRepository('LvLibraryBundle:Library')
            ->findAll();

        $res = [];

        $rpcClient = $this->get('rpc.client.handler');

        /* @var Library $lib*/
        foreach ($libs as $lib){

            $method = 'libs.'. $lib->getCity()->getAlias() . '.getStatisticsBooksOnHandForCustomerName';

            $rpcRes = $rpcClient
                ->setUrl($lib->getUrl())
                ->call($method, ['customerName' => $this->customerName])
                ->resultToArray();
            $res[$lib->getCity()->getName()] = isset($rpcRes['result']) ? $rpcRes['result'] : $rpcRes;
        }

        return $res;
    }
}
